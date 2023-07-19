<?php

namespace App\Http\Controllers;

use App\Models\SchoolMember;
use App\Models\User;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use App\Notifications\PushDemo;
use Illuminate\Support\Facades\Cache;
use Notification as webNotification;
use Segment\Segment;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = SchoolMember::with('user')->whereUserId(auth()->user()->id)->first();
        if (empty($school)) {
            return back();
        }
        $students = SchoolMember::with('student')->where('user_id', '!=', auth()->user()->id)->whereSchoolId($school->school_id)->get();
        return view('chat.index', compact(['students']));


        // $school = SchoolMember::with('user')->whereUserId(auth()->user()->id)->first();
        // if (empty($school)) {
        //     return back();
        // }
        // $students = SchoolMember::with('student')->where('user_id', '!=', auth()->user()->id)->whereSchoolId($school->school_id)->get();
        // $studentDetails = User::find($id);
        // if (empty($studentDetails)) {
        //     return back();
        // }

        // return view('chat.view', compact(['students']));
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
        $from = auth()->user()->id;
        $to = $request->receiver_id;
        $data = new Chat();
        $data->sender_id = $from;
        $data->receiver_id = $to;
        $data->message = $request->message;
        // if (strpos(strtolower($request->message), 'us05web.zoom.us') == 8) {
        //     $data->type = 4;
        // }
        $data->type = 1;
        $data->seen = 0; // message will be unread when sending message
        $data->save();



        $webpush = [];
        $webpush['title'] = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $webpush['body'] = $request->message;
        $data = webNotification::send(User::where('id', $to)->first(), new PushDemo($webpush));


        // sendWebNotification($user, $title, $body);

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

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'chat-event', $data);


        // ANALYTICS: SEND DIRECT MESSAGE
        $school_id = SchoolMember::with('user')->whereUserId($from)->first()->school_id;
        $school_name = User::where('id', $school_id)->first()->name;
        Segment::track(array(
            "userId" => $from,
            "event" => "Chat",
            "properties" => array(
                "type"=>"dm",
                "school_name"=>$school_name,
                "school_id"=>$school_id,
                "user_to_id"=>$to,
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
    public function show($id)
    {

        // return Chat::whereSenderId($id)->whereReceiverId(auth()->user()->id)->get();
        $school = SchoolMember::with('user')->whereUserId(auth()->user()->id)->first();
        if (empty($school)) {
            return back();
        }

        Chat::whereSenderId($id)->whereReceiverId(auth()->user()->id)->update(['seen' => 1]);

        $students = SchoolMember::with('student')
            // ->withCount('pendingChatCount')
            ->where('user_id', '!=', auth()->user()->id)
            ->whereSchoolId($school->school_id)
            ->get();

        // dd($students->toArray());

        $studentDetails = User::find($id);
        if (empty($studentDetails)) {
            return back();
        }


        return view('chat.view', compact(['students', 'studentDetails']));
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


    public function message($user)
    {
        $me = auth()->user()->id;
        $receiver_id = $user;

        $messages = Chat::select(
            'message',
            'type',
            'seen',
            'chats.created_at',
            'sender_id',
            'receiver_id',
            'users.first_name',
            'users.last_name',
            'users.profile',
            DB::raw('CASE WHEN sender_id = ' . $me . ' THEN receiver_id ELSE sender_id END as sender')
        )
            ->leftJoin('users', 'users.id', '=', DB::raw('CASE WHEN sender_id = ' . $me . ' THEN receiver_id ELSE sender_id END'), 'inner')
            ->where('receiver_id', $receiver_id)->where('sender_id', $me)
            ->orWhere(function ($q) use ($receiver_id, $me) {
                $q->where('sender_id', $receiver_id)->where('receiver_id', $me);
            })->orderBy('created_at', 'asc');

        $messages = $messages->orderBy('created_at', 'desc')->get();
        // dd($messages);

        if ($messages->count() > 0) {
            Chat::where('receiver_id', $me)->where('sender_id', $receiver_id)->update(['seen' => 1]);
        }
        $studentDetails = User::find($user);
        if (empty($studentDetails)) {
            return back();
        }

        return view('chat.message', compact(['studentDetails', 'messages']));
    }

    public function studentinfo($id)
    {
        $studentInfo = User::find($id);
        // dd($studentInfo);
        return response()->json(['data' => $studentInfo]);
    }

    public function userStatus(Request $request)
    {
        $school = SchoolMember::with('user')->whereUserId(auth()->user()->id)->first();
        if (empty($school)) {
            return back();
        }
        $students = SchoolMember::with('student')->where('user_id', '!=', auth()->user()->id)->whereSchoolId($school->school_id)->get();
        // dd($students->toArray());
        if ($students) {
            $resArr = [];
            foreach ($students as $student) {
                if (Cache::has('user-is-online-' . $student->student->id)) {
                    $result['id'] = $student->student->id;
                    $result['status'] = true;
                } else {
                    $result['id'] = $student->student->id;
                    $result['status']  = false;
                }
                if ($student->student->pending_chat_count != 0) {
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
