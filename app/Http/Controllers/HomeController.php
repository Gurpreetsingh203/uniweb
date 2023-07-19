<?php

namespace App\Http\Controllers;

use App\Models\GroupChatSeen;
use App\Models\SchoolGroup;
use App\Models\SchoolGroupMember;
use App\Models\SchoolMember;
use App\Models\SchoolSubGroup;
use App\Models\SchoolSubGroupMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd(Auth::user()->role);

        // if (Auth::user()->role != config('constant.STUDENT')) {
        //     Session::flush();
        //     Auth::logout();
        //     // return 'hg';
        //     return redirect(route('login'));
        // }
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myGroups = SchoolGroupMember::select('school_groups.*')
            ->join('school_groups', 'school_group_members.school_group_id', 'school_groups.id')
            ->where('school_group_members.user_id', auth()->user()->id)
            ->get();

        $school = SchoolMember::with('user')->whereUserId(auth()->user()->id)->first();

        $students = null;
        if ($school) {
            $students = SchoolMember::with('student')->where('user_id', '!=', auth()->user()->id)->whereSchoolId($school->school_id)->get();
        }
        // dd($students);

        $group = SchoolGroupMember::whereUserId(auth()->user()->id)->first();
        if ($group) {
            return redirect()->route('group', ['group' => $group->school_group_id]);
        }
        return view('home', compact(['myGroups', 'school', 'students']));
    }

    public function group($group)
    {
        $this->expireTag($group);
        $myGroups = SchoolGroupMember::select('school_groups.*')
            ->join('school_groups', 'school_group_members.school_group_id', 'school_groups.id')
            ->where('school_group_members.user_id', auth()->user()->id)
            // ->withCount('unseenMsg')
            ->get();
        // dd($myGroups->toArray());

        $school = SchoolMember::with('user')->whereUserId(auth()->user()->id)->first();
        $subGroups = SchoolSubGroup::whereSchoolGroupId($group)->get();
        $subGroupIds = SchoolSubGroup::whereSchoolGroupId($group)->pluck('id');
        $mySubGroups = [];
        if ($subGroupIds) {
            $mySubGroups = SchoolSubGroupMember::with('subGroup')->whereIn('school_sub_group_id', $subGroupIds)->whereUserId(auth()->user()->id)->latest()->get();
        }


        $students = SchoolGroupMember::with('student')->whereSchoolGroupId($group)->where('user_id', '!=', auth()->user()->id)->get();
        // dd($subGroupMembers->toArray());

        // $students = SchoolMember::with('student')->where('user_id', '!=', auth()->user()->id)->whereSchoolId($school->school_id)->latest()->get();
        // dd($students->toArray());
        return view('home', compact(['myGroups', 'school', 'students', 'subGroups', 'mySubGroups']));
    }




    public function registerStatus()
    {
        $isSchoolMember = SchoolMember::whereUserId(auth()->user()->id)->first();

        $isSchoolGroupMember = SchoolGroupMember::whereUserId(auth()->user()->id)->first();

        if (!$isSchoolMember || !$isSchoolGroupMember) {
            return response()->json(['status' => false]);
        } else {
            return response()->json(['status' => true]);
        }
    }

    public function expireTag($group)
    {
        $dt = Carbon::now();
        $expireSubGroups = SchoolSubGroup::where('expire_at', '!=', null)->whereSchoolGroupId($group)->get();
        if ($expireSubGroups) {
            foreach ($expireSubGroups as $expireSubGroup) {
                if ($dt >= $expireSubGroup->expire_at) {
                    // dump($expireSubGroup);
                    SchoolSubGroup::whereId($expireSubGroup->id)->delete();
                }
            }
        }
    }

    public function userStatus(Request $request){
        $students = SchoolGroupMember::with('student')->whereSchoolGroupId($request->group)->where('user_id', '!=', auth()->user()->id)->get();
        if($students){
            $resArr = [];
            foreach($students as $student){
                if(Cache::has('user-is-online-' . $student->student->id)){
                    $result['id'] = $student->student->id;
                    $result['status'] = true;
                } else {
                    $result['id'] = $student->student->id;
                    $result['status']  = false;
                }
                if ($student->student->pending_chat_count != 0){
                    $result['pending_chat_count'] = $student->student->pending_chat_count;
                } else {
                    $result['pending_chat_count'] = '';
                }

                $resArr[] = $result;
            }
        }
        // dd($students->toArray());
        return $resArr;
    }
}
