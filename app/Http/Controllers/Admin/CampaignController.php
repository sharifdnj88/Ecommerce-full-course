<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CampaignController extends Controller
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
            $imgurl='storage/campaigns';
            $data=DB::table('campaigns')->latest()->get();
            return FacadesDataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image',function($row) use($imgurl) {
                        return '<img src="'.$imgurl.'/'.$row->image.'" height="40" width="90">';
                    })  
                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<a href="#"><span class="badge badge-success">Active</span> </a>';
                        }else{
                            return '<a href="#"><span class="badge badge-danger">Inactive</span> </a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="#" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a>
                        <a href="'.route('campaign.delete', [$row->id]).'"  class="btn btn-danger btn-sm" id="product_delete"><i class="fa fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','image','status'])
                    ->make(true);       
        }

        return view('admin.offer.campaign.index');
    }

    // Campaign Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:campaigns|max:55',
            'start_date' => 'required',
            'discount' => 'required',
         ]);       

        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;
        $data['month']=date('F');
        $data['year']=date('Y');

        // Campaign photo upload
        $slug=Str::slug($request->title, '-');
        $photo=$request->image;
        $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(870,197)->save( storage_path('app/public/campaigns/'). $photoname );
        $data['image']=$photoname; 

        DB::table('campaigns')->insert($data);       

        $notification=array('messege' => 'Campaign Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Campaign Edit Method
    public function edit($id)
    {
        $edit=DB::table('campaigns')->where('id', $id)->first();
        return view('admin.offer.campaign.edit', compact('edit'));
    }

    // Campaign Update
    public function update(Request $request)
    {    

        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;
        $data['month']=date('F');
        $data['year']=date('Y');

        if ($request->image) {
            if ($request->old_image ) {
                  unlink('storage/campaigns/'. $request->old_image);
              }
          $slug=Str::slug($request->title, '-');
          $photo=$request->image;
          $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
          Image::make($photo)->resize(870,197)->save( storage_path('app/public/campaigns/'). $photoname );
          $data['image']=$photoname; 

            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification=array('messege' => 'Campaign Update!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
      }else{
        $data['image']=$request->old_image;
        DB::table('campaigns')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Campaign Update!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
      }  

    }


    //delete method
    public function destroy($id)
    {
        $data=DB::table('campaigns')->where('id', $id)->first();
        DB::table('campaigns')->where('id', $id)->delete();

        $image=$data->image;

        if ($image) {
            unlink('storage/campaigns/'. $image);
        }

        DB::table('campaigns')->where('id',$id)->delete();
        return response()->json('Campaign deleted!');
    }




}
