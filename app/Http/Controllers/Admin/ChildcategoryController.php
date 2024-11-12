<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ChildcategoryController extends Controller
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

    // All ChildCategory Show Method
    public function index()
    {   
        $data=DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
    		    ->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();
        $category = DB::table('categories')->get();
        return view('admin.category.childcategory.index', compact('data', 'category'));
    }

    // Child-Category Create Method
    public function store(Request $request)
    {

        $validated = $request->validate([
            'childcategory_name' => 'required|unique:childcategories|max:55',
        ]);

        $scat=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

       $data=array();
       $data['category_id']=$scat->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');
       $data['childcategory_name']=$request->childcategory_name;
       DB::table('childcategories')->insert($data);
       $notification=array('messege' => 'Child-Category Inserted!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);

    }

    // child Category Edit Method
    public function edit($id)
    {
            // Query Builder
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id', $id)->first();

        return view('admin.category.childcategory.edit', compact('data', 'category'));
    }

    // CHild Category Update Method
    public function update(Request $request)
    {
        $scat=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
            // Query Builder System
        $data=array();
        $data['category_id']=$scat->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');
        $data['childcategory_name']=$request->childcategory_name;
        DB::table('childcategories')->where('id', $request->id)->update($data);
        $notification=array('messege' => 'Child-Category Update!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Child Category Delete Method
    public function destroy($id)
    {
        DB::table('childcategories')->where('id', $id)->delete();
        $notification=array('messege' => 'Child-Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


}
