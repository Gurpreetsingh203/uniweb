<?php

use App\Models\Fcmtoken;
use App\Models\SchoolSubGroupMember;

function fullImgUrl($file)
{
    if (isset($file) && $file != "") {
        return asset('storage/' . $file);
    } else {
        return "";
    }
}


// function sendWebNotification($user, $title, $body, $isGroup = null)
// {
//     $url = 'https://fcm.googleapis.com/fcm/send';

//     if ($isGroup) {
//         $FcmToken = SchoolSubGroupMember::join('fcmtokens', 'school_sub_group_members.user_id', 'fcmtokens.user_id')
//             ->whereSchoolSubGroupId($user)
//             ->where('school_sub_group_members.user_id', '!=', auth()->user()->id)
//             ->select('fcmtokens.*')
//             ->pluck('token')
//             ->all();
//     } else {
//         $FcmToken = Fcmtoken::whereUserId($user)->whereNotNull('token')->pluck('token')->all();
//     }

//     // dd($FcmToken);


//     $serverKey = env('FCM_SERVER_KEY');

//     $data = [
//         "registration_ids" => $FcmToken,
//         "notification" => [
//             "title" => $title,
//             "body" => $body,
//         ]
//     ];
//     $encodedData = json_encode($data);

//     $headers = [
//         'Authorization:key=' . $serverKey,
//         'Content-Type: application/json',
//     ];

//     $ch = curl_init();

//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//     curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//     // Disabling SSL Certificate support temporarly
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
//     // Execute post
//     $result = curl_exec($ch);
//     if ($result === FALSE) {
//         die('Curl failed: ' . curl_error($ch));
//     }
//     // Close connection
//     curl_close($ch);
//     // FCM response
//     // dd($result);
// }
