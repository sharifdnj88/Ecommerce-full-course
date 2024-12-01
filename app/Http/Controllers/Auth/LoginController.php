<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request-> password))) {

            if (auth()->user()->is_admin==1) {
                $user=auth()->user()->name;
                $notification=array('messege' => 'Welcome 🙂 ' . $user, 'alert-type' => 'success');
    	        return redirect()->route('admin.home')->with($notification);
            }else{                
                return redirect()->back();
            }

        }else{
            $notification=array('messege' => 'Invalid email or password !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

    }

    // Admin Login Page Show
    public function adminLogin(){
        return view('auth.admin_login');        
    }


}
