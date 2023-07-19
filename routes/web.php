<?php

use App\Http\Controllers\MeetingController;
use App\Http\Middleware\SchoolAdmin;
use App\Http\Middleware\Student;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/password/reset/success', function () {
//     // return redirect(route('login'));
//     return view('success-msg');
// });

Auth::routes();

Route::get('meetings', [MeetingController::class, 'index'])->name('meetings');
Route::get('meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
Route::get('meetings/userAuthorize', [MeetingController::class, 'userAuthorize'])->name('meetings.userAuthorize');
Route::post('meetings/store', [MeetingController::class, 'store'])->name('meetings.store');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirect'])->name('google-login');

Route::get('/google/rollback', [App\Http\Controllers\GoogleLoginController::class, 'rollback']);

Route::post('student/store', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('create.student');

Route::middleware(['auth'])->group(function () {

    Route::middleware([Student::class])->group(function () {

        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('student/register/status', [App\Http\Controllers\HomeController::class, 'registerStatus'])->name('student-register-status');

        Route::get('student/register/back/course', [App\Http\Controllers\HomeController::class, 'backCourse'])->name('student-register-back-course');

        Route::get('/school-group/{group}', [App\Http\Controllers\HomeController::class, 'group'])->name('group');

        Route::get('/user-status', [App\Http\Controllers\HomeController::class, 'userStatus'])->name('user-status');

        Route::post('edit-profile', [App\Http\Controllers\UserController::class, 'editProfile'])->name('edit.profile');

        Route::get('search-school', [App\Http\Controllers\SchoolController::class, 'search'])->name('search-school');

        Route::get('groups-of-school', [App\Http\Controllers\SchoolGroupController::class, 'search'])->name('groups-of-school');

        Route::resource('school-group-member', App\Http\Controllers\SchoolGroupMemberController::class);

        Route::resource('school-sub-group', App\Http\Controllers\SchoolSubGroupController::class);

        Route::resource('school-sub-group-member', App\Http\Controllers\SchoolSubGroupMemberController::class);

        Route::resource('chat', App\Http\Controllers\ChatController::class);

        Route::get('/chat-user-status', [App\Http\Controllers\ChatController::class, 'userStatus'])->name('chat-user-status');


        Route::resource('zoom/meeting', App\Http\Controllers\ZoomMeetingController::class);

        // Route::get('/join/zoom/meeting/generate/token', [App\Http\Controllers\ZoomMeetingController::class, 'generateZoomToken'])->name('join-zoom-meeting-generate-token');

        Route::post('/join/zoom/meeting', [App\Http\Controllers\ZoomMeetingController::class, 'join'])->name('join-zoom-meeting');

        Route::get('/chat/user/message/{user}', [App\Http\Controllers\ChatController::class, 'message'])->name('user-message');

        Route::post('/group/chat', [App\Http\Controllers\GroupChatController::class, 'store'])->name('group-chat-store');

        Route::get('/group/chat/{subgroup}', [App\Http\Controllers\GroupChatController::class, 'show'])->name('group-chat-show');

        Route::get('/group-chat-user-status', [App\Http\Controllers\GroupChatController::class, 'userStatus'])->name('group-chat-user-status');


        Route::get('/group/chat/message/{subgroup}', [App\Http\Controllers\GroupChatController::class, 'message'])->name('group-chat-message');

        Route::post('/group/chat/upload/media', [App\Http\Controllers\GroupChatController::class, 'media'])->name('group-chat-upload-media');

        Route::post('/group/chat/user/reaction', [App\Http\Controllers\GroupChatController::class, 'reaction'])->name('group-chat-user-reaction');

        Route::post('/group/chat/user/reaction/remove', [App\Http\Controllers\GroupChatController::class, 'reactionRemove'])->name('group-chat-user-reaction-remove');

        Route::resource('zendesk', App\Http\Controllers\ZendeskController::class);

        // Route::post('/store-token', [App\Http\Controllers\NotificationController::class, 'store'])->name('store-token');

        Route::post('/store-token', [App\Http\Controllers\PushController::class, 'store'])->name('store-token');

        Route::get('/direct-message-count', [App\Http\Controllers\PushController::class, 'count'])->name('direct-message-count');

    });



    // Route::group(['prefix' => 'admin'], function () {

    Route::middleware([SuperAdmin::class])->group(function () {

        Route::resource('school', App\Http\Controllers\SchoolController::class);
    });

    Route::middleware([SchoolAdmin::class])->group(function () {

        Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('user', App\Http\Controllers\UserController::class);

        Route::resource('change-password', App\Http\Controllers\Admin\ChangePasswordController::class);

        Route::resource('group', App\Http\Controllers\SchoolGroupController::class);
    });
    // });
});







Route::group(['prefix' => 'admin'], function () {

    Route::resource(
        'login',
        App\Http\Controllers\Admin\Auth\LoginController::class,
        [
            'names' => [
                'index' => 'admin.login',
                'store' => 'admin.login',
            ]
        ]
    );

    Route::get('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {

        Route::middleware([SuperAdmin::class])->group(function () {

            Route::resource('school', App\Http\Controllers\SchoolController::class);
        });

        Route::middleware([SchoolAdmin::class])->group(function () {

            Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

            Route::resource('user', App\Http\Controllers\UserController::class);

            Route::resource('change-password', App\Http\Controllers\Admin\ChangePasswordController::class);

            Route::resource('group', App\Http\Controllers\SchoolGroupController::class);
        });
    });
});
