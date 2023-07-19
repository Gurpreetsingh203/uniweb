<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroup;
use App\Models\SchoolSubGroup;
use App\Models\SchoolMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Segment\Segment;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schoolId = (isset($request->school)) ? $request->school : auth()->user()->id;
        $students = SchoolMember::whereSchoolId($schoolId)->pluck('user_id');
        // dd($students);
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = User::whereRole(config('constant.STUDENT'))
                ->when($students, function ($query, $students) {
                    $query->whereIn('id', $students);
                })
                ->selectRaw('*,@rownum  := @rownum  + 1 AS rowCount');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="text-center">
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
        return view('admin.user.index', ['title' => 'Student', 'page' => 'user']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

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

    public function editProfile(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:8048',
                'first_name' => ['required', 'string', 'max:10'],
                'last_name' => ['required', 'string', 'max:10'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,' . auth()->user()->id],
                // 'country_code' => 'required|regex:/^\+\d{1,3}$/',
                // 'contact' => ['required', 'unique:users,contact,' . auth()->user()->id, 'min:8', 'max:15', 'regex:/^\d{1,15}$/'],
                'contact' => ['required', 'unique:users,contact,' . auth()->user()->id],
                'zoom_client_id' => 'required',
                'zoom_client_secret_key' => 'required',
            ],
            [
                'contact.required' => 'The phone number field is required.',
                'contact.phone' => 'Please pass only usa number.',
                'profile.max' => "Maximum profile file size to upload is 8MB (8048 KB). If you are uploading a photo, try to reduce its resolution to make it under 8MB",
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }

        $data = $validator->validated();
        if ($request->profile) {
            Storage::delete('public/' . auth()->user()->profile);
            $data['profile'] = $request->profile->store('user/profile', ['disk' => 'public']);
        }



        // ANALYTICS: EDIT USER PROFILE
        $userId = auth()->user()->id;
        $school_id = SchoolMember::with('user')->whereUserId($userId)->first()->school_id;
        $school_name = User::where('id', $school_id)->first()->name;
        Segment::track(array(
            "userId" => $userId,
            "event" => "EditProfile",
            "properties" => array(
                "type"=>"EditProfile",
                "school_name"=>$school_name,
                "school_id"=>$school_id,
                "time"=>now(),
            )
        ));
        Segment::flush();


        return User::whereId(auth()->user()->id)->update($data);
    }
}
