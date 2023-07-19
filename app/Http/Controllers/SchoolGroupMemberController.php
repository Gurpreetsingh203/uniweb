<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolGroupMemberController extends Controller
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
        $validator = Validator::make(
            $request->all(),
            [
                'group' => [
                    'required'
                ],
            ],
            [
                'group.required' => 'The group field is required.',
            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }


        // dd($request->all());
        if (isset($request->group)) {
            foreach ($request->group as $group) {
                SchoolGroupMember::create([
                    'school_group_id' => $group,
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        return redirect()->route('home');
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
