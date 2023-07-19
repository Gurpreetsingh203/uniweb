<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class PushController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = User::find(auth()->user()->id);
        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true], 200);
    }


    public function count()
    {
        $pendingChatCount = Chat::select('sender_id')->whereReceiverId(auth()->user()->id)->whereSeen(0)
        // ->groupBy('sender_id')
        ->get();
        if(count($pendingChatCount) > 0){
            return count($pendingChatCount);
        }
    }
}
