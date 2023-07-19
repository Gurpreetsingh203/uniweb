<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirect()
    {

        return Socialite::driver('google')->redirect();
    }

    public function rollback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
        $isUser = User::whereProviderType('google')->whereProviderId($user->id)->whereIsSocial(true)->first();
        // dd($isUser);
        if (!$isUser) {
            $emailExist = User::whereEmail($user->email)->first();
            if ($emailExist) {
                return redirect(route('login'))->with('error', 'This email address is already registered in uniwebs with another login method.');
            }

            $user = User::create([
                'first_name' => $user->user['given_name'],
                'last_name' => $user->user['family_name'],
                'email' => $user->email,
                'provider_id' => $user->id,
                'provider_type' => 'google',
                'is_social' => true,
                'role' => config('constant.STUDENT'),
            ]);
            // $isZoomUser = $this->createZoomUser($user);
            // if (isset($isZoomUser->id)) {
            //     User::whereId($user->id)->update(['zoom_id' => $isZoomUser->id]);
            // }
        } else {
            $user = $isUser;
        }

        Auth::login($user);
        return redirect(route('home'));
    }


    // public function createZoomUser($user)
    // {
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://zoom.us/oauth/token');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
    //         CURLOPT_URL => 'https://api.zoom.us/v2/users',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => '{
    //             "action": "create",
    //                 "user_info": {
    //                     "email": "' . $user->email . '",
    //                     "first_name": "' . $user->first_name . '",
    //                     "last_name": "' . $user->last_name . '",
    //                     "type": 1
    //                 }
    //             }',
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json',
    //             'Accept: application/json',
    //             'Authorization: Bearer ' . $data->access_token . '',
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     // dd($response);
    //     curl_close($curl);
    //     return json_decode($response);
    // }
}
