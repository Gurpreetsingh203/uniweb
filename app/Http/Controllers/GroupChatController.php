<?php

namespace App\Http\Controllers;

use App\Models\GroupChat;
use App\Models\GroupChatReaction;
use App\Models\GroupChatSeen;
use App\Models\SchoolGroup;
use App\Models\SchoolSubGroup;
use App\Models\SchoolSubGroupMember;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PushDemo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Notification as webNotification;
use Segment\Segment;

class GroupChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('group-chat');
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
        $from = auth()->user()->id;
        $group_id = $request->group_id;
        $data = new GroupChat();
        $data->school_sub_group_id = $group_id;
        $data->sender_id = $from;
        $data->message = $request->message;

        $data->type = 1;
        $data->save();


        $groupMembers = SchoolSubGroupMember::whereSchoolSubGroupId($request->group_id)->where('user_id', '!=', $from)->get();
        if ($groupMembers) {
            foreach ($groupMembers as $groupMember) {
                $seenData = new GroupChatSeen();
                $seenData->user_id = $groupMember->user_id;
                $seenData->school_sub_group_id = $request->group_id;
                $seenData->save();
            }
        }

        $groupData = SchoolSubGroup::whereId($request->group_id)->first();
        // $user = $request->group_id;
        // $title = $groupData->name;
        // $body = $request->message;
        // sendWebNotification($user, $title, $body, true);

        $users = SchoolSubGroupMember::whereSchoolSubGroupId($request->group_id)
            ->where('user_id', '!=', auth()->user()->id)
            ->get();


        $webpush = [];
        $webpush['title'] = $groupData->name;
        $webpush['body'] = $request->message;
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
        // $pusher->trigger('group-chat', 'group-chat-event', $data);


        // ANALYTICS: SEND GROUP MESSAGE: text
        $courseId = SchoolSubGroup::whereId($request->group_id)->first()->school_group_id;
        $schoolGroupData = SchoolGroup::select('school_groups.name as school_group_name', 'users.name as school_name', 'school_groups.school_id')
        ->join('users', 'school_groups.school_id', 'users.id')
        ->where('school_groups.id', $courseId)
        ->first();

        $schoolGroupId = $courseId;
        $schoolGroupName = $schoolGroupData->school_group_name;
        $schoolName = $schoolGroupData->school_name;
        $schoolId = $schoolGroupData->school_id;


        Segment::track(array(
            "userId" => $from,
            "event" => "TagChat",
            "properties" => array(
                "type"=>"tag chat",
                "school_name"=>$schoolName,
                "school_id"=>$schoolId,
                "course_name"=>$schoolGroupName,
                "course_id"=>$schoolGroupId,
                "tag_name"=>$groupData->name,
                "tag_id"=>$group_id,
                "msg_type"=>"txt",
                "time"=>now(),
            )
        ));
        Segment::flush();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subgroup)
    {

        // return auth()->user()->zoom_client_id;

        GroupChatSeen::whereSchoolSubGroupId($subgroup)->whereUserId(auth()->user()->id)->update(['seen' => 1]);

        $ongoingMeeting = GroupChat::select(
            'group_chats.id',
            'message',
            'sender_id',
            'type',
            'start_url',
            'join_url',
            'group_chats.created_at',
            'users.first_name',
            'users.last_name',
            'users.profile',

        )
            ->whereSchoolSubGroupId($subgroup)
            ->leftJoin('users', 'users.id', '=', 'group_chats.sender_id')
            ->orderBy('group_chats.created_at', 'desc')
            ->whereType(4)
            ->get();




        $from_time = strtotime(Carbon::now());
        if ($ongoingMeeting) {
            foreach ($ongoingMeeting as $ongoing) {
                $to_time = strtotime($ongoing->created_at);
                $diff_minutes = (int)round(abs($from_time - $to_time) / 60);
                if ($diff_minutes >= 30) {
                    GroupChat::whereId($ongoing->id)->delete();
                }
            }
        }


        $isGroup = SchoolSubGroupMember::whereSchoolSubGroupId($subgroup)->whereUserId(auth()->user()->id)->first();
        if (empty($isGroup)) {
            return redirect()->route('home');
        }

        // dd($subgroup);

        $subGroup = SchoolSubGroup::whereId($subgroup)->first();
        $subGroupMembers = SchoolSubGroupMember::with('user')->whereSchoolSubGroupId($subgroup)->where('user_id', '!=', auth()->user()->id)->get();
        // dd($subGroupMembers->toArray());


        // $verifyUsers = [];
        // $subZoomVerifyGroupMembers = SchoolSubGroupMember::with('user')
        //     ->whereHas('user', function ($q) {
        //         $q->where('zoom_id', '!=', null);
        //     })
        //     ->whereSchoolSubGroupId($subgroup)->get();
        // // dd($subZoomVerifyGroupMembers->toArray());
        // if ($subZoomVerifyGroupMembers) {
        //     foreach ($subZoomVerifyGroupMembers as $subZoomVerifyGroupMember) {
        //         $checkVerify = $this->isActiveUser($subZoomVerifyGroupMember->user->email);
        //         if (isset($checkVerify->existed_email) && $checkVerify->existed_email == true) {
        //             $verifyUser['first_name'] = $subZoomVerifyGroupMember->user->first_name;
        //             $verifyUser['last_name'] = $subZoomVerifyGroupMember->user->last_name;
        //             $verifyUser['email'] = $subZoomVerifyGroupMember->user->email;
        //             $verifyUser['user_id'] = $subZoomVerifyGroupMember->user->id;
        //             $verifyUsers[] = $verifyUser;
        //         }
        //     }
        // }

        // dd($verifyUsers);

        return view('group-chat.index', compact(['subGroup', 'subGroupMembers', 'ongoingMeeting']));
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


    public function message($subgroup)
    {

        $groupId = $subgroup;
        $me = auth()->user()->id;

        $messages = GroupChat::select(
            'group_chats.id',
            'message',
            'school_sub_group_id',
            'sender_id',
            'type',
            'original_file_name',
            'start_url',
            'join_url',
            'users.first_name',
            'users.last_name',
            'users.profile',

        )
            ->with(['reactions'])
            ->whereSchoolSubGroupId($subgroup)
            // ->whereType(1)
            ->leftJoin('users', 'users.id', '=', 'group_chats.sender_id')
            ->orderBy('group_chats.created_at', 'asc')
            ->get();

        $subGroup = SchoolSubGroup::whereId($subgroup)->first();
        $subGroupMembers = SchoolSubGroupMember::with('user')->whereSchoolSubGroupId($subgroup)->where('user_id', '!=', auth()->user()->id)->get();
        return view('group-chat.message', compact(['messages', 'subGroup', 'subGroupMembers']));
    }

    public function media(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'media' => 'nullable|max:8048',
            ],
            [
                'media.max' => "Maximum media file size to upload is 8MB (8048 KB).",
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }

        // dd($request->all());
        $from = auth()->user()->id;
        $data = new GroupChat();
        $data->school_sub_group_id = $request->school_sub_group_id;
        $data->sender_id = $from;
        $data->message = $request->media->store('chat/media', ['disk' => 'public']);
        $data->original_file_name = $request->media->getClientOriginalName();
        $data->type = $request->type;
        $data->save();


        $groupMembers = SchoolSubGroupMember::whereSchoolSubGroupId($request->school_sub_group_id)->where('user_id', '!=', $from)->get();
        if ($groupMembers) {
            foreach ($groupMembers as $groupMember) {
                $seenData = new GroupChatSeen();
                $seenData->user_id = $groupMember->user_id;
                $seenData->school_sub_group_id = $request->school_sub_group_id;
                $seenData->save();
            }
        }


        $groupData = SchoolSubGroup::whereId($request->school_sub_group_id)->first();
        // $user = $request->school_sub_group_id;
        // $title = $groupData->name;
        // $body = $request->media->getClientOriginalName();
        // sendWebNotification($user, $title, $body, true);


        $users = SchoolSubGroupMember::whereSchoolSubGroupId($request->school_sub_group_id)
            ->where('user_id', '!=', auth()->user()->id)
            ->get();


        $webpush = [];
        $webpush['title'] = $groupData->name;
        $webpush['body'] = $request->media->getClientOriginalName();
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

        $data = ['from' => $from, 'to' => $request->school_sub_group_id]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function reaction(Request $request)
    {

        // dd(preg_replace("~\u{1F600}~", '', $request->emoji));
        $groupReaction = GroupChatReaction::whereGroupChatId($request->group_id)
            ->whereSchoolSubGroupId($request->school_sub_group_id)
            ->whereUserId(auth()->user()->id)
            // ->where('emoji',preg_replace("~\u{1F600}~", '', $request->emoji))
            ->get();
        // dd($request->emoji);
        if (!empty($groupReaction)) {
            foreach ($groupReaction as $reac) {
                if ($reac->emoji == $request->emoji) {
                    $reacId = $reac->id;
                }
            }
        }
        // dd($reacId);
        if (isset($reacId)) {
            GroupChatReaction::where('id', $reacId)->delete();
        }
        // dd($reacId);
        // dd();
        // dd($request->all());
        // dd($groupReaction);

        $from = auth()->user()->id;
        GroupChatReaction::create([
            'group_chat_id' => $request->group_id,
            'school_sub_group_id' => $request->school_sub_group_id,
            'user_id' => auth()->user()->id,
            'emoji' => $request->emoji
        ]);


        $groupData = SchoolSubGroup::whereId($request->school_sub_group_id)->first();

        $users = SchoolSubGroupMember::whereSchoolSubGroupId($request->school_sub_group_id)
            ->where('user_id', '!=', auth()->user()->id)
            ->get();

        $groupChatMessage = GroupChat::whereId($request->message_id)->first();
        $webpush = [];
        $webpush['title'] = $groupData->name;
        $webpush['body'] = 'Reacted ' . $request->emoji . ' to":' . $groupChatMessage->message . '"'; //$request->media->getClientOriginalName();
        if ($users) {
            foreach ($users as $user) {
                $data = webNotification::send(User::where('id', $user->user_id)->first(), new PushDemo($webpush));
            }
        }


        $total = GroupChatReaction::whereGroupChatId($request->message_id)->whereSchoolSubGroupId($request->school_sub_group_id)->get();
        $emojies = $total->groupBy('emoji')->map(function ($row) {
            return $row->count();
        });

        // dd($emojies);


        $output = '';
        if (count($emojies) > 0) {
            foreach ($emojies as $key => $emojie) {
                $output .= "<li onclick=removeEmoji($request->message_id,$request->school_sub_group_id,'$key')>
                <a href='#!'  class='badge'>
                    <span>$emojie  $key </span>
                </a>
            </li>";
            }
        }


        //pusher
        // $options = array(
        //     'cluster' => env('PUSHER_APP_CLUSTER'),
        //     'useTLS' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['from' => $from, 'to' => $request->group_id]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);


        return $output;
    }


    public function reactionRemove(Request $request)
    {
        $groupReaction = GroupChatReaction::whereGroupChatId($request->group_id)
            ->whereSchoolSubGroupId($request->school_sub_group_id)
            ->whereUserId(auth()->user()->id)
            ->get();
        if (!empty($groupReaction)) {
            foreach ($groupReaction as $reac) {
                if ($reac->emoji == $request->emoji) {
                    $reacId = $reac->id;
                }
            }
        }

        if (isset($reacId)) {
            // dd($reacId);
            GroupChatReaction::where('id', $reacId)->delete();
        }



        $total = GroupChatReaction::whereGroupChatId($request->message_id)->whereSchoolSubGroupId($request->school_sub_group_id)->get();
        $emojies = $total->groupBy('emoji')->map(function ($row) {
            return $row->count();
        });

        $output = '';
        if (count($emojies) > 0) {
            foreach ($emojies as $key => $emojie) {
                // onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')"
                $output .= "<li onclick=removeEmoji($request->message_id,$request->school_sub_group_id,'$key')>
                    <a href='#!'  class='badge'>
                        <span>$emojie  $key </span>
                    </a>
                </li>";
            }
        }
        return $output;
    }


    public function userStatus(Request $request)
    {
        $subGroupMembers = SchoolSubGroupMember::with('user')->whereSchoolSubGroupId($request->subgroup)->where('user_id', '!=', auth()->user()->id)->get();

        if ($subGroupMembers) {
            $resArr = [];
            foreach ($subGroupMembers as $subGroupMember) {
                if (Cache::has('user-is-online-' . $subGroupMember->user->id)) {
                    $result['id'] = $subGroupMember->user->id;
                    $result['status'] = true;
                } else {
                    $result['id'] = $subGroupMember->user->id;
                    $result['status']  = false;
                }
                if ($subGroupMember->user->pending_chat_count != 0) {
                    $result['pending_chat_count'] = $subGroupMember->user->pending_chat_count;
                } else {
                    $result['pending_chat_count'] = '';
                }

                $resArr[] = $result;
            }
        }
        // dd($students->toArray());
        return $resArr;
    }

    public function unseenMsg($group)
    {
        // $subGroupIds = SchoolSubGroup::whereSchoolGroupId($group)->pluck('id');
        // $mySubGroups = [];
        // if ($subGroupIds) {
        //     $mySubGroups = SchoolSubGroupMember::with('subGroup')->whereIn('school_sub_group_id', $subGroupIds)->whereUserId(auth()->user()->id)->latest()->get();
        // }
    }

    // public function isActiveUser($email)
    // {

    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://zoom.us/oauth/token');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=account_credentials&account_id=JaOTmOziQgGXhYXdB0y6qA");

    //     $headers = array();
    //     $headers[] = 'Host: zoom.us';
    //     $headers[] = 'Authorization: Basic ' . base64_encode('Tc03FYRnRZeybyloaHdGAg:4UWIY2UpsSj4JVIB0ugsQ8infoSrELWs') . '';
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //     $result = curl_exec($ch);

    //     if (curl_errno($ch)) {
    //         return curl_error($ch);
    //     }
    //     curl_close($ch);

    //     $data = json_decode($result);


    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.zoom.us/v2/users/email?email=' . $email . '',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_HTTPHEADER => array(
    //             'Accept: application/json',
    //             'Authorization: Bearer ' . $data->access_token . '',
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     return json_decode($response);
    // }
}
