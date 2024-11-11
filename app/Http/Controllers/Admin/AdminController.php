<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Admin Home
    public function admin(){
        return view('admin.home');
    }

    //admin custome logout
    public function logout()
    {
    	Auth::logout();
    	$notification=array('messege' => 'You are logged out!', 'alert-type' => 'success');
    	return redirect()->route('admin.login')->with($notification);
    }


}
