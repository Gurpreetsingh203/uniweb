<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateSchoolRequest;
use App\Http\Requests\Admin\EditSchoolRequest;
use App\Jobs\SchoolCrenditial;
use App\Models\SchoolMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class SchoolController extends Controller
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
            $data = User::whereRole(config('constant.SCHOOLADMIN'))->selectRaw('*,@rownum  := @rownum  + 1 AS rowCount');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="text-center">
                        <a href="' . route('school.edit', ['school' => $row->id]) . '"><button type="button" class="btn btn-dark btn-icon-text btn-lg">Edit<i class="ti-file btn-icon-append"></i></button></a>
                        <a href="javascript:void(0)" onclick="confirmDelete(' . $row->id . ')"><button type="button" class="btn btn-danger btn-icon-text btn-lg delete-school"><i class="mdi mdi-delete-forever"></i>Delete</button></a>
                    </div>';
                    return $btn;
                })
                ->addColumn('created', function ($row) {
                    $date = date("d F Y", strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('group', function ($row) {
                    $btn = '<div class="text-center">
                        <a href="' . route('group.index', ['school' => $row->id]) . '"><button type="button" class="btn btn-success btn-icon-text btn-lg"><i class="mdi mdi-library-plus"></i></button></a>
                    </div>';
                    return $btn;
                })
                ->addColumn('student', function ($row) {
                    $btn = '<div class="text-center">
                        <a href="' . route('user.index', ['school' => $row->id]) . '"><button type="button" class="btn btn-warning btn-icon-text btn-lg"><i class="mdi mdi-format-list-bulleted"></i></button></a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'group', 'student'])
                ->make(true);
        }
        return view('admin.school.index', ['title' => 'School', 'page' => 'school']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.school.create', ['title' => 'School', 'page' => 'school']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSchoolRequest $request)
    {
        $password = Str::random(10);
        $data = $request->validated();
        $data['role'] = config('constant.SCHOOLADMIN');
        $data['password'] = $password;
        $school = User::create($data);
        $details = [
            'email' => $request->email,
            'password' => $password
        ];
        // SchoolCrenditial::dispatch($details);
        \Mail::to($request->email)->send(new \App\Mail\SchoolCrenditials($details));
        return redirect(route('school.index'))->with('success', 'School added successfully.');
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
        $school = User::whereId($id)->first();
        return view('admin.school.edit', ['title' => 'School', 'page' => 'school'], compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSchoolRequest $request, $id)
    {
        User::whereId($id)->update($request->validated());
        return redirect(route('school.index'))->with('success', 'School edit successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::whereId($id)->delete();
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $data = User::whereRole(config('constant.SCHOOLADMIN'))->where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($data);
    }
}
