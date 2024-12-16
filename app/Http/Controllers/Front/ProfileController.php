<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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

    // Customer Password Change
    public function CustomerPasswordChange(Request $request)
    {
        // $validated = $request->validate([
        //     'old_password'  => 'required',
        //     'password'      => 'required|min:6|confirmed',
        //  ]); 

        if($request->password!=$request->password_confirmation){
            return response()->json('Password Confirmation not match!'); 
        }

         if ($request->old_password=='' || $request->password=='' || $request->password_confirmation=='' ) {
            return response()->json('All fields are required!'); 
        }

        $current_password=Auth::user()->password;
        $old_pass=$request->old_password;
        if (Hash::check($old_pass,$current_password)) { 
               $user=User::findorfail(Auth::id());   
               $user->password=Hash::make($request->password); 
               $user->save(); 
            //    Auth::logout(); 
               return response()->json('Your Password Changed!');
        }else{
            return response()->json('Old Password Not Matched!');
        }
    }


    
}
