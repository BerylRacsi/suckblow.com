<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Partner;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	if(Auth::guard('partner')->check()){
            $user = Partner::find(Auth::id());
        }
        else if(Auth::guard('web')->check()){
            $user = User::find(Auth::id());
        }

    	return view('main/dashboard/index',compact('user'));
    }
}
