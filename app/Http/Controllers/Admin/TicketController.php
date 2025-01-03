<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Str;

class TicketController extends Controller
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

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $ticket="";
              $query=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');
                   
                if ($request->date) {
                    $query->where('tickets.date',$request->date);
                 }

                 if ($request->type=='Technical') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Payment') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Affiliate') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Return') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Refund') {
                    $query->where('tickets.service',$request->type);
                 }

                if ($request->status==1) {
                     $query->where('tickets.status',1);
                }

                if ($request->status==0) {
                    $query->where('tickets.status',0);
                }

                if ($request->status==2) {
                    $query->where('tickets.status',2);
                }

            $ticket=$query->select('tickets.*','users.name')->get();
            return FacadesDataTables::of($ticket)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<span class="badge badge-warning"> Running </span>';
                        }elseif($row->status==2){
                            return '<span class="badge badge-danger"> Close </span>';
                        }else{
                            return '<span class="badge badge-danger"> Pending </span>';
                        }
                    })
                    ->editColumn('date',function($row){
                       return date('d F Y', strtotime($row->date));
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('admin.ticket.show',[$row->id]).'" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="'.route('admin.ticket.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_ticket"><i class="fa fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status','date'])
                    ->make(true);       
        }
        return view('admin.ticket.index');
    }

    //__show method
    public function show($id)
    {
        $ticket=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
        return view('admin.ticket.view_ticket',compact('ticket'));
    }


    public function ReplyTicketStore(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['user_id']=0;
        $data['reply_date']=date('Y-m-d');

        if ($request->image) {
            $slug='SharifBD-ecommerce';
            $photo=$request->image;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,300)->save( storage_path('app/public/ticket/'). $photoname );
            $data['image']=$photoname; 
         }
        
        DB::table('replies')->insert($data);
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>1]);
        $notification=array('messege' => 'Replied Done!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function CloseTicket($id)
    {
         DB::table('tickets')->where('id',$id)->update(['status'=>2]);
         $notification=array('messege' => 'Ticket Closed!', 'alert-type' => 'success');
         return redirect()->route('ticket.index')->with($notification);
    }

    public function destroy($id)
    {
        DB::table('tickets')->where('id',$id)->delete();
        return response()->json('successfully deleted!');
    }



}
