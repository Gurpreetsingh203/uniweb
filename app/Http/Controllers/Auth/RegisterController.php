<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SchoolMember;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:10'],
            'last_name' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'country_code' => 'required',
            'contact' => ['required', 'unique:users', 'min:8', 'max:15', 'regex:/^\d{1,15}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country_code' => '+' . $data['country_code'],
            'contact' => $data['contact'],
            'role' => config('constant.STUDENT'),
            'password' => Hash::make($data['password']),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => ['required', 'string', 'max:10'],
                'last_name' => ['required', 'string', 'max:10'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                // 'country_code' => 'required|regex:/^\+\d{1,3}$/',
                // 'contact' => ['required', 'unique:users', 'min:8', 'max:15', 'regex:/^\d{1,15}$/'],
                'contact' => ['nullable', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'contact.required' => 'The phone number field is required.',
                'contact.phone' => 'Please pass only usa number.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'contact' => $request->contact,
            'role' => config('constant.STUDENT'),
            'password' => $request->password,
        ]);

        // $isZoomUser = $this->createZoomUser($user);
        // if (isset($isZoomUser->id)) {
        //     User::whereId($user->id)->update(['zoom_id' => $isZoomUser->id]);
        // }
        Auth::login($user);
        return true;
    }


    // public function createZoomUser($user)
    // {
    //     // dd($data->email);
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
