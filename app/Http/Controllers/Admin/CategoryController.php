<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        //query builder
    	// $data=array();
    	// $data['category_name']=$request->category_name;
    	// $data['category_slug']=Str::slug($request->category_name, '-');
    	// DB::table('categories')->insert($data);

        $slug=Str::slug($request->category_name, '-');
        Category::insert([
            'category_name'=> $request->category_name,
            'category_slug'=> $slug
        ]);

        $notification=array('messege' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);


    }

    //Category edit method
    public function edit($id)
    {
    	// $data=DB::table('categories')->where('id',$id)->first();
        $data=Category::findorfail($id);
        return response()->json($data);
    }

    // Category Update Method
    public function update(Request $request){
        // Query builder
        // $id=$request->id;
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['category_slug']=Str::slug($request->category_name, '-');
        // DB::table('categories')->where('id', $id)->update($data);

        // Eloquent ORM
        $category =Category::where('id', $request->id);
        $category->update([
            'category_name'=> $request->category_name,
            'category_slug'=> Str::slug($request->category_name, '-')
        ]);

        $notification=array('messege' => 'Category Update Successfully', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);

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
