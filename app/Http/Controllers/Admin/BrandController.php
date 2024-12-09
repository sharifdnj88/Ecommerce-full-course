<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
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

    // All Brand GET Method
    public function index()
    {
        $data = DB::table('brands')->get();
        return view('admin.category.brand.index', compact('data'));
    }

    // Brand Create POST Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);        

        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=Str::slug($request->brand_name, '-');
        $data['front_page']=$request->front_page;

        // Brand photo upload
        $slug=Str::slug($request->brand_name, '-');
        $photo=$request->brand_logo;
        $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(240,120)->save( storage_path('app/public/brands/'). $photoname );
        $data['brand_logo']=$photoname; 

        DB::table('brands')->insert($data);       

        $notification=array('messege' => 'Brand Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    // Brand Edit Method
    public function edit($id)
    {
        $data=DB::table('brands')->where('id', $id)->first();
        return view('admin.category.brand.edit', compact('data'));
    }

    // Brand Update Method
    public function update(Request $request)
    {
    	
    	$data=array();
    	$data['brand_name']=$request->brand_name;
    	$data['brand_slug']=Str::slug($request->brand_name, '-');
        $data['front_page']=$request->front_page;


    	if ($request->brand_logo) {
    		  if ($request->old_logo ) {
                    unlink('storage/brands/'. $request->old_logo);
    	        }
            $slug=Str::slug($request->brand_name, '-');
            $photo=$request->brand_logo;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(240,120)->save( storage_path('app/public/brands/'). $photoname );
            $data['brand_logo']=$photoname; 

    	      DB::table('brands')->where('id',$request->id)->update($data);
    	      $notification=array('messege' => 'Brand Update!', 'alert-type' => 'success');
    	      return redirect()->back()->with($notification);
    	}else{
		  $data['brand_logo']=$request->old_logo;
	      DB::table('brands')->where('id',$request->id)->update($data);
	      $notification=array('messege' => 'Brand Update!', 'alert-type' => 'success');
	      return redirect()->back()->with($notification);
    	}     
       

    }

    // Brand Delete Method
    public function destroy($id)
    {
        $data=DB::table('brands')->where('id', $id)->first();
        DB::table('brands')->where('id', $id)->delete();

        $image=$data->brand_logo;

        if ($image) {
            unlink('storage/brands/'. $image);
        }


        $notification=array('messege' => 'Brand deleted successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



}
