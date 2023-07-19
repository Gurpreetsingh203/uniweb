<?php

namespace App\Http\Controllers;

use App\Models\GroupChat;
use App\Models\JoinMeeting;
use App\Models\SchoolGroup;
use App\Models\SchoolSubGroup;
use App\Models\SchoolSubGroupMember;
use App\Models\User;
use App\Traits\ZoomMeetingTrait;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Notifications\PushDemo;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Notification as webNotification;
use Segment\Segment;

class ZoomMeetingController extends Controller
{
    // use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // private $client;
    // private $jwt;
    // private $headers;
    // private $user;
    // private $key;
    // private $secret;


    // public function __construct()
    // {
    //     $this->client = new Client();
    //     $this->jwt = $this->generateZoomToken();
    //     $this->headers = [
    //         'Authorization' => 'Bearer ' . $this->generateZoomToken(),
    //         'Content-Type'  => 'application/json',
    //         'Accept'        => 'application/json',
    //     ];
    //     $this->user = auth()->user();
    //     $this->key = (isset(auth()->user()->zoom_client_id)) ? auth()->user()->zoom_client_id : env('ZOOM_API_KEY', '');
    //     $this->secret = (isset(auth()->user()->zoom_client_secret_key)) ? auth()->user()->zoom_client_secret_key : env('ZOOM_API_SECRET', '');
    // }


    public function index()
    {
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://zoom.us/oauth/token');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=account_credentials&account_id=JaOTmOziQgGXhYXdB0y6qA");

        // $headers = array();
        // $headers[] = 'Host: zoom.us';
        // $headers[] = 'Authorization: Basic ' . base64_encode('Tc03FYRnRZeybyloaHdGAg:4UWIY2UpsSj4JVIB0ugsQ8infoSrELWs') . '';
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $result = curl_exec($ch);

        // if (curl_errno($ch)) {
        //     return curl_error($ch);
        // }
        // curl_close($ch);

        // $data = json_decode($result);

        // // return $data->access_token;

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://api.zoom.us/v2/users',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //         "action": "create",
        //         "user_info": {
        //             "email": "jchill@example.com",
        //             "first_name": "Jill",
        //             "last_name": "Chill",
        //             "type": 1
        //         }
        //         }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json',
        //         'Accept: application/json',
        //         'Authorization: Bearer '.$data->access_token.'',
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // return json_decode($response);




        // $request = array();
        // $request['topic'] = 'szdf';
        // return $this->create($request);
        return $this->get('81334529361');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $meeting = $this->create($request->all());
        $from = auth()->user()->id;
        $group_id = $request->group_id;
        $data = new GroupChat();
        $data->school_sub_group_id = $group_id;
        $data->sender_id = $from;
        $data->message = $request->topic;
        $data->meeting_id = $meeting['meeting_id'];
        $data->start_url = $meeting['start_url'];
        $data->join_url = $meeting['join_url'];
        $data->type = 4;
        $data->save();


        $groupData = SchoolSubGroup::whereId($request->group_id)->first();
        // $user = $request->group_id;
        // $title = $groupData->name;
        // $body = $meeting['join_url'];
        // sendWebNotification($user, $title, $body, true);


        $users = SchoolSubGroupMember::whereSchoolSubGroupId($request->group_id)
            ->where('user_id', '!=', auth()->user()->id)
            ->get();
        $webpush = [];
        $webpush['title'] = $groupData->name;
        $webpush['body'] = $meeting['join_url'];
        if ($users) {
            foreach ($users as $user) {
                $data = webNotification::send(User::where('id', $user->user_id)->first(), new PushDemo($webpush));
            }
        }



        // pusher
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $group_id]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
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

    public function join(Request $request)
    {
        $isZoomMeeting = JoinMeeting::whereGroupChatId($request->group_id)->whereUserId(auth()->user()->id)->first();
        if (!$isZoomMeeting) {
            $joinMeeting = new JoinMeeting();
            $joinMeeting->group_chat_id = $request->group_id;
            $joinMeeting->user_id = auth()->user()->id;
            $joinMeeting->save();
        }

        // ANALYTICS: JOIN ZOOM MEETING
        $groupData = SchoolSubGroup::whereId($request->group_id)->first();
        $courseId = SchoolSubGroup::whereId($request->group_id)->first()->school_group_id;
        $schoolGroupData = SchoolGroup::select('school_groups.name as school_group_name', 'users.name as school_name', 'school_groups.school_id')
        ->join('users', 'school_groups.school_id', 'users.id')
        ->where('school_groups.id', $courseId)
        ->first();

        $schoolGroupId = $courseId;
        $schoolGroupName = $schoolGroupData->school_group_name;
        $schoolName = $schoolGroupData->school_name;
        $schoolId = $schoolGroupData->school_id;
        $userId = auth()->user()->id;


        Segment::track(array(
            "userId" => $userId,
            "event" => "JoinMeeting",
            "properties" => array(
                "type"=>"JoinMeeting",
                "school_name"=>$schoolName,
                "school_id"=>$schoolId,
                "course_name"=>$schoolGroupName,
                "course_id"=>$schoolGroupId,
                "tag_name"=>$groupData->name,
                "tag_id"=>$request->group_id,
                "time"=>now(),
            )
        ));
        Segment::flush();

        return true;
    }


    public function generateZoomToken()
    {
        // dd(auth()->user()->zoom_client_id);
        $key = (isset(auth()->user()->zoom_client_id)) ? auth()->user()->zoom_client_id : env('ZOOM_API_KEY', '');
        $secret = (isset(auth()->user()->zoom_client_secret_key)) ? auth()->user()->zoom_client_secret_key : env('ZOOM_API_SECRET', '');

        // $key = env('ZOOM_API_KEY', '');
        // $secret = env('ZOOM_API_SECRET', '');


        // $user = User::whereId(Auth::id())->first();
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];

        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    public function create($data)
    {
        $path = 'users/me/meetings';
        $url = $this->retrieveZoomUrl();
        $date = Carbon::now()->toDateString();
        $body = [
            'headers' =>  [
                'Authorization' => 'Bearer ' . $this->generateZoomToken(),
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
            'body'    => json_encode([
                'topic'      => $data['topic'],
                'type'       => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($date),
                'duration'   => 30,
                'agenda' => $data['topic'],
                'timezone'     => 'Asia/Kolkata',
                'settings'   => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                    'join_before_host' => true,
                    'approval_type' => 1,
                    'waiting_room' => false


                ],
            ]),
        ];

        $client = new Client();
        $response =  $client->post($url . $path, $body);
        $result = json_decode($response->getBody(), true);



        // // ANALYTICS: CREATE MEETING
        // BEN TODO: should this go in the store function or here? Store obviously means it's a new meeting
        // $groupData = SchoolSubGroup::whereId($data->group_id)->first();
        // $courseId = SchoolSubGroup::whereId($data->group_id)->first()->school_group_id;
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
        //     "event" => "CreateMeeting",
        //     "properties" => array(
        //         "type"=>"CreateMeeting",
        //         "school_name"=>$schoolName,
        //         "school_id"=>$schoolId,
        //         "course_name"=>$schoolGroupName,
        //         "course_id"=>$schoolGroupId,
        //         "tag_name"=>$groupData->name,
        //         "tag_id"=>$data->group_id,
        //         "time"=>now(),
        //     )
        // ));
        // Segment::flush();
        


        return [
            'success' => $response->getStatusCode() === 201,
            'data'    => json_decode($response->getBody(), true),
            'meeting_id' => $result['id'],
            'start_url' => $result['start_url'],
            'join_url' => $result['join_url']
        ];
    }

    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', '');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());

            return '';
        }
    }
}
