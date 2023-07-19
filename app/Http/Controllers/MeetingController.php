<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Timezone;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeetingController extends Controller
{
    public function index() {
        return view('meetings.index', [
            'meetings' => Meeting::get(),
        ]);
    }

    public function create() {
        try {
            $query = http_build_query([
                'client_id' => config('services.zoomApi.clientId'),
                'redirect_uri' => 'https://uniwebs.test/meetings/userAuthorize',
                'response_type' => 'code',
            ]);

            return redirect('https://zoom.us/oauth/authorize?'.$query);
        } catch(Exception $e) {
            Log::info('Error when authorize the user: '. $e);
            return redirect('meetings')->with('error', __('Something went wrong!'));
        }
    }

    public function userAuthorize(Request $request) {
        return view('meetings.create', [
            'timezones' => Timezone::get(),
            'code' => $request->input('code'),
        ]);
    }

    public function store(Request $request) {
        try {
            $code = $request['code'];
            $data = [
                "topic" => $request['topic'],
                "type" =>  $request['type'],
                "start_time" => Carbon::parse($request['start_time'])->format('Y-m-d,H:i:s'),
                "duration" => $request['duration'],
                "timezone" => $request['timezone'],
                "settings" => [
                    "host_video" => true,
                    "participant_video" =>true,
                    "join_before_host" =>true,
                    "mute_upon_entry" =>"true",
                    "watermark" => "true",
                    "audio" => "voip",
                    "auto_recording" => "cloud"
                ],
            ];

            $response  = Http::withHeaders([
                "Authorization" => "Basic ".base64_encode("AK0Q7icTSgOwW3yYwxsVyw:r5kp57a3FQIIAx8XnVgTky3psKLVOEMb"),
                "Content-Type" => "application/x-www-form-urlencoded",
            ])
            ->asForm()
            ->post("https://zoom.us/oauth/token?grant_type=authorization_code&code=$code&redirect_uri=https://uniwebs.test/meetings/userAuthorize");

            if ($response->failed()) {
                Log::info('Error for generating access token: '. $response);
                return redirect('meetings')->with('error', __('Something went wrong!'));
            }

            $accessToken = json_decode($response->body())?->access_token;
            $meetingResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
            ])->post('https://api.zoom.us/v2/users/me/meetings', $data);

            if ($meetingResponse->failed()) {
                Log::info('Error when hit create zoom meeting api call: '. $meetingResponse);
                return redirect('meetings')->with('error', __('Something went wrong!'));
            }

            $meetingBody = json_decode($meetingResponse->body());

            Meeting::create([
                'user_id' => Auth::id(),
                'uuid' => $meetingBody->uuid ?? null,
                'host_id' => $meetingBody->host_id ?? null,
                'topic' => $meetingBody->topic ?? null,
                'description' => $request['description'] ?? null,
                'type' => $meetingBody->type ?? null,
                'status' => $meetingBody->status ?? null,
                'start_time' => $meetingBody->start_time ?? null,
                'duration' => $meetingBody->duration ?? null,
                'timezone' => $meetingBody->timezone ?? null,
                'start_url' => $meetingBody->start_url ?? null,
                'join_url' => $meetingBody->join_url ?? null,
                'password' => $request->password ?? $meetingBody->password,
                'encrypted_password' => $meetingBody->password ?? null,
                'security' => $request['security'] ?? null,
                'host_video' =>  $request['host_video'] ?? $meetingBody->settings->host_video,
                'participant_video' => $request['host_video'] ?? $meetingBody->settings->participant_video,
                'allow_participate_join_everytime' => $request['allow_participate_join_everytime'] ?? null,
                'join_before_host' => $request['join_before_host'] ??$meetingBody->settings->join_before_host,
            ]);

            return redirect('meetings')->with('success', 'Meeting create successfully!');

        } catch(Exception $e) {
            Log::info('Error when store the meeting record into database: '. $e);
            return redirect('meetings')->with('error', __('Something went wrong!'));
        }
    }

}
