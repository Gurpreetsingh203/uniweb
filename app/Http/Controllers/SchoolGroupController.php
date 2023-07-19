<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateSchoolGroupRequest;
use App\Models\SchoolGroup;
use App\Models\SchoolMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SchoolGroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = SchoolGroup::when($request, function ($query, $request) {
                // if (auth()->user()->role != config('constant.SCHOOLADMIN')) {
                //     $query->whereUserId(auth()->user()->id);
                // }
            })
                ->selectRaw('*,@rownum  := @rownum  + 1 AS rowCount')
                // ->latest()
                ->whereSchoolId($request->school);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="text-center">
                        <a href="' . route('group.edit', ['group' => $row->id]) . '"><button type="button" class="btn btn-dark btn-icon-text btn-lg">Edit<i class="ti-file btn-icon-append"></i></button></a>
                        <a href="javascript:void(0)" onclick="confirmDelete(' . $row->id . ')"><button type="button" class="btn btn-danger btn-icon-text btn-lg delete-school"><i class="mdi mdi-delete-forever"></i>Delete</button></a>
                    </div>';
                    return $btn;
                })
                ->addColumn('created', function ($row) {
                    $date = date("d F Y", strtotime($row->created_at));
                    return $date;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.school.group.index', ['title' => 'Group', 'page' => 'group']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.school.group.create', ['title' => 'Group', 'page' => 'group']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSchoolGroupRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $school = SchoolGroup::create($data);
        return redirect(route('group.index', ['school' => $school->school_id]))->with('success', 'Group added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = SchoolGroup::whereId($id)->first();
        return view('admin.school.group.edit', ['title' => 'School', 'page' => 'school'], compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSchoolGroupRequest $request, $id)
    {
        SchoolGroup::whereId($id)->update($request->validated());
        return redirect(route('group.index', ['school' => $request->school_id]))->with('success', 'Group edit successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return SchoolGroup::whereId($id)->delete();
    }


    public function search(Request $request)
    {
        $name = $request->name;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    Rule::exists('users')->where(function ($query) use ($name) {
                        return $query->where('name', $name)->where('role', config('constant.SCHOOLADMIN'));
                    }),
                ],
            ],
            [
                'name.required' => 'The institution field is required.',
                'name.exists' => 'The selected institution is invalid.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }


        if ($request->ajax()) {
            $school = User::whereName($request->school)->first();
            $groups = [];
            if ($school) {
                SchoolMember::whereUserId(auth()->user()->id)->delete();
                SchoolMember::create([
                    'school_id' => $school->id,
                    'user_id' => auth()->user()->id
                ]);
                $groups = SchoolGroup::whereSchoolId($school->id)->get();
            }
            $li = '';
            if (count($groups) > 0) {
                foreach ($groups as $group) {
                    $li .= '<li>
                    <div class="form-check">
                        <input class="form-check-input" name="group[]" type="checkbox" value="' . $group->id . '" id="group">
                            <label class="form-check-label" for="flexCheckDefault">
                                ' . $group->name . '
                            </label>
                        </div>
                    </li>';
                }
            }
        }
        return $li;
    }
}
