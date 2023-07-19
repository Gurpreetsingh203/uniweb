<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroup;
use App\Models\SchoolSubGroup;
use App\Models\SchoolSubGroupMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Segment\Segment;

class SchoolSubGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        // dd($request->all());
        $isAvailable = SchoolSubGroup::whereSchoolGroupId($request->school_group_id)->whereName($request->name)->first();
        if ($isAvailable) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:30', 'unique:school_sub_groups,name'],
                'timeframe' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:30'],
                'timeframe' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }


        $dt = Carbon::now();
        if ($request->timeframe == '1 week') {
            $expireAT = $dt->addWeeks(1)->format('Y-m-d h:i:s');
        } elseif ($request->timeframe == '2 week') {
            $expireAT = $dt->addWeeks(2)->format('Y-m-d h:i:s');
        } elseif ($request->timeframe == '3 week') {
            $expireAT = $dt->addWeeks(3)->format('Y-m-d h:i:s');
        } elseif ($request->timeframe == 'a month') {
            $expireAT = $dt->addMonth(1)->format('Y-m-d h:i:s');
        } else {
            $expireAT = null;
        }

        $subGroup = SchoolSubGroup::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'school_group_id' => $request->school_group_id,
            'timeframe' => $request->timeframe,
            'expire_at' => $expireAT
        ]);

        SchoolSubGroupMember::create([
            'school_sub_group_id' => $subGroup->id,
            'user_id' => auth()->user()->id
        ]);



        // ANALYTICS: CREATE TAG
        // $courseId = SchoolGroup::whereId($request->group_id)->first()->school_group_id;
        // $schoolGroupData = SchoolGroup::select('school_groups.name as school_group_name', 'users.name as school_name', 'school_groups.school_id')
        // ->join('users', 'school_groups.school_id', 'users.id')
        // ->where('school_groups.id', $courseId)
        // ->first();

        // $schoolGroupId = $courseId;
        // $schoolGroupName = $schoolGroupData->school_group_name;
        // $schoolName = $schoolGroupData->school_name;
        // $schoolId = $schoolGroupData->school_id;


        // Segment::track(array(
        //     "userId" => auth()->user()->id,
        //     "event" => "CreateTag",
        //     "properties" => array(
        //         "type"=>"CreateTag",
        //         "school_name"=>$schoolName,
        //         "school_id"=>$schoolId,
        //         "course_name"=>$schoolGroupName,
        //         "course_id"=>$request->group_id,
        //         "tag_name"=>$request->name,
        //         "tag_id"=>$subGroup->id,
        //         "time"=>now(),
        //     )
        // ));
        Segment::track(array(
            "userId" => auth()->user()->id,
            "event" => "CreateTag",
            "properties" => array(
                "type"=>"CreateTag",
                "school_name"=>-1,
                "school_id"=>-1,
                "course_name"=>-1,
                "course_id"=>$request->group_id,
                "tag_name"=>$request->name,
                "tag_id"=>$subGroup->id,
                "time"=>now(),
            )
        ));
        Segment::flush();



        return true;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
