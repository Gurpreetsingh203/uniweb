<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroup;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $schoolCount = User::whereRole(config('constant.SCHOOLADMIN'))->count();
        $studentCount = User::whereRole(config('constant.STUDENT'))->count();
        $groupCount = SchoolGroup::whereUserId(auth()->user()->id)->count();
        return view('admin.dashboard',['page' => 'dashboard'], compact(['schoolCount','studentCount','groupCount']));
    }
}
