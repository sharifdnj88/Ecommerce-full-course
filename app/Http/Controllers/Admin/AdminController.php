<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // Admin Profile Method
    public function profile()
    {
        return view('admin.profile.index');
    }

    // Admin Password Change
    public function profilePasswordChange(Request $request)
    {
        $validated = $request->validate([
            'old_password'  => 'required',
            'password'      => 'required|min:6|confirmed',
         ]); 

        $current_password=Auth::user()->password;
        $old_pass=$request->old_password;
        if (Hash::check($old_pass,$current_password)) { 
               $user=User::findorfail(Auth::id());   
               $user->password=Hash::make($request->password); 
               $user->save(); 
               Auth::logout(); 
               $notification=array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
               return redirect()->route('admin.login')->with($notification);
        }else{
            $notification=array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }


    }


}
