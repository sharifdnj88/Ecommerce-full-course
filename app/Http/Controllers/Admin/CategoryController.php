<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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

    // All Category Show Method
    public function index()
    {
        $data = DB::table('categories')->get();
        return view('admin.category.category.index', compact('data'));
    }

    // Category Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        $data['home_page']=$request->home_page;

        // Category photo upload
        $slug=Str::slug($request->category_name, '-');
        $photo=$request->icon;
        $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(32,32)->save( storage_path('app/public/categories/'). $photoname );
        $data['icon']=$photoname;

        DB::table('categories')->insert($data);

        $notification=array('messege' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
        


    }

    //Category edit method
    public function edit($id)
    {
    	// $data=DB::table('categories')->where('id',$id)->first();
        $edit=Category::findorfail($id);
        return view('admin.category.category.edit', compact('edit'));
    }

    // Category Update Method
    public function update(Request $request){
        
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        $data['home_page']=$request->home_page;

        if ($request->icon) {
            if ($request->old_image ) {
                  unlink('storage/campaigns/'. $request->old_image);
              }
          $slug=Str::slug($request->category_name, '-');
          $photo=$request->icon;
          $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
          Image::make($photo)->resize(32,32)->save( storage_path('app/public/categories/'). $photoname );
          $data['icon']=$photoname; 
          DB::table('categories')->where('id',$request->id)->update($data);

          $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
      }else{
        $data['icon']=$request->old_icon;
        DB::table('categories')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
      }  

    }

    //delete category method
    public function destroy($id)
    {
    	//query builder
    	   //DB::table('categories')->where('id',$id)->delete();
    	//eleqoent ORM
    	$category=Category::findOrFail($id);
    	$category->delete();

    	$notification=array('messege' => 'Category Deleted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);
    }


    //get child category
    public function GetChildCategory($id)  //subcategory_id
    {
        $data=DB::table('childcategories')->where('subcategory_id',$id)->get();
        return response()->json($data);
    }




}
