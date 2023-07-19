<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Huddle\Zendesk\Facades\Zendesk;
use Illuminate\Support\Facades\Validator;
use Adrii\ZendeskAPI;
use App\Models\SchoolMember;
use App\Models\User;
use Segment\Segment;


class ZendeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $data = array(
        //     "username" => "HG",
        //     "subject" => "Uniwebs feedback",
        //     "body" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tempor semper enim. Nam non semper ligula. Vestibulum sapien sapien, hendrerit pharetra elementum a, faucibus id nisl. Aenean ornare rhoncus ligula, eget efficitur augue suscipit vehicula. Fusce faucibus odio magna, sit amet aliquet ipsum sodales a.",
        //     "first_name" => "Hardik",
        //     "last_name" => "Gorasiya HG",
        //     "email" => "hardik.iroid@gmail.com",
        // );


        // // for ($i = 0; $i < count($files); $i++) {
        // //     $zendesk->upload($files[$i]['name'], $files[$i]['tmp_name']);
        // // }

        // $comment = array(
        //     array(
        //         'subject'       => $data['subject'],
        //         'comment'       => array(
        //             'body'      => $data['body'],
        //             'public'    => false,
        //             // "uploads"   => $zendesk->getUpload()
        //         ),
        //         'requester'     => array(
        //             'name'      => $data['first_name'] . " " . $data['last_name'],
        //             'email'     => $data['email'],
        //         ),
        //         'priority'      => 'normal',
        //     )
        // );

        // // dd($comment);

        // $subdomain  = env('ZENDESK_SUBDOMAIN');
        // $user       = env('ZENDESK_USERNAME');
        // $token      = env('ZENDESK_TOKEN');

        // $zend = new ZendeskApi($subdomain, $user, $token);

        // return $zend->create($comment);
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
                'subject' => ['required'],
                'comment' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }

        $subdomain  = env('ZENDESK_SUBDOMAIN');
        $user       = env('ZENDESK_USERNAME');
        $token      = env('ZENDESK_TOKEN');

        $zend = new ZendeskApi($subdomain, $user, $token);

        $data = array(
            "subject" => $request->subject,
            "body" => $request->comment,
            "first_name" => auth()->user()->first_name,
            "last_name" => auth()->user()->last_name,
            "email" => auth()->user()->email,
        );

        $files = $request->file('attachment');
        if ($files) {
            for ($i = 0; $i < count($files); $i++) {
                $zend->upload($files[$i]);
            }
        }


        $comment = array(
            array(
                'subject'       => $data['subject'],
                'comment'       => array(
                    'body'      => $data['body'],
                    'public'    => false,
                    "uploads"   => $files ? $zend->getUpload() : ''
                ),
                'requester'     => array(
                    'name'      => $data['first_name'] . " " . $data['last_name'],
                    'email'     => $data['email'],
                ),
                'priority'      => 'normal',
            )
        );

        $zend->create($comment);
        // $content = json_encode(['body' => $request->comment, 'email' => auth()->user()->email]);
        // $newTicket = \Zendesk::tickets()->create([
        //     'subject'  =>  $request->subject,
        //     'email' => auth()->user()->email,
        //     'comment'  => [
        //         'body' => $content
        //     ],
        //     'requester'     => array(
        //         'name'      => $data['first_name'] . " " . $data['last_name'],
        //         'email'     => $data['email'],
        //     ),
        //     'priority' => 'normal'
        // ]);
        //Low,Normal,High,Urgent



        // ANALYTICS: send help forum request
        $from = auth()->user()->id;
        $school_id = SchoolMember::with('user')->whereUserId($from)->first()->school_id;
        $school_name = User::where('id', $school_id)->first()->name;
        Segment::track(array(
            "userId" => $from,
            "event" => "HelpForum",
            "properties" => array(
                "type"=>"HelpForumRequest",
                "school_name"=>$school_name,
                "school_id"=>$school_id,
                "user_from_id"=>$from,
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
