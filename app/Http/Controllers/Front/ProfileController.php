<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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

    //________Ticket Store Method
    public function TicketStore(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
         ]);

        $data=array();
        $data['subject']=$request->subject;
        $data['service']=$request->service;
        $data['priority']=$request->priority;
        $data['message']=$request->message;
        $data['user_id']=Auth::id();
        $data['status']=0;
        $data['date']=date('Y-m-d');

         if ($request->image) {
            $slug=Str::slug($request->subject, '-');
            $photo=$request->image;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,300)->save( storage_path('app/public/ticket/'). $photoname );
            $data['image']=$photoname; 
         }
        
        DB::table('tickets')->insert($data);

        $notification=array('messege' => 'Ticket Send Successfully!', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification);


    }


    //__ticket show
    public function TicketShow($id)
    {
        $ticket=DB::table('tickets')->where('id',$id)->first();
        return view('frontend.ticket.show_ticket',compact('ticket'));
    }

    //__reply ticket
    public function ReplyTicket(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['user_id']=Auth::id();
        $data['reply_date']=date('Y-m-d');

        if ($request->image) {
            $slug='SharifBD-ecommerce';
            $photo=$request->image;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,300)->save( storage_path('app/public/ticket/'). $photoname );
            $data['image']=$photoname; 
         }
        
        DB::table('replies')->insert($data);

        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>0]);

        $notification=array('messege' => 'Replied Done!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    
}
