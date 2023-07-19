<?php

namespace App\Http\Controllers;

use App\Models\SchoolSubGroupMember;
use Illuminate\Http\Request;

class SchoolSubGroupMemberController extends Controller
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
        $isAdd = SchoolSubGroupMember::whereSchoolSubGroupId($request->id)->whereUserId(auth()->user()->id)->first();
        if (empty($isAdd)) {
            SchoolSubGroupMember::create([
                'school_sub_group_id' => $request->id,
                'user_id' => auth()->user()->id
            ]);
            return response()->json(['status' => true, 'message' => 'You are added in this group.']);
        }
        return response()->json(['status' => false, 'message' => 'You are already added in this group.']);
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
        return SchoolSubGroupMember::whereSchoolSubGroupId($id)->whereUserId(auth()->user()->id)->delete();
    }
}
