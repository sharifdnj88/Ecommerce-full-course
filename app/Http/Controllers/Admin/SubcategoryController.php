<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
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

    // All Subcategory Show Method
    public function index()
    {
        // Query Builder
        // $data=DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
    	//       ->select('subcategories.*','categories.category_name')->get();

             //Eloquent ORM
    	$data=Subcategory::all();
    	$category=Category::all();  

        return view('admin.category.subcategory.index', compact('data', 'category'));
    }

    // Subcategory Created Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|unique:subcategories|max:55',
        ]);

        // Query Builder
        // $data=array();
        // $data['category_id']=$request->category_id;
        // $data['subcategory_name']=$request->subcategory_name;
        // $data['subcategory_slug']=Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->insert($data);

        // Eloquent ORM
        Subcategory::insert([
            'category_id'       => $request->category_id,
            'subcategory_name'  => $request->subcategory_name,
            'subcategory_slug'  => Str::slug($request->subcategory_name, '-')
        ]);

        $notification=array('messege' => 'Subcategory Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    // Subcategory Edit Method
    public function edit($id)
    {
        // Query Builder
        // $data = DB::table('subcategories')->where('id', $id)->first();
        // $category = DB::table('categories')->get();

        // Eloquent ORM
        $data = Subcategory::findOrFail($id);
        $category = Category::all();

        return view('admin.category.subcategory.edit', compact('data', 'category'));

    }

    // Subcategory Update Method
    public function update(Request $request)
    {
        // Query Builder System
        // $data=array();
        // $data['category_id']       =$request->category_id;
        // $data['subcategory_name']  =$request->	subcategory_name;
        // $data['subcategory_slug']  =Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->where('id', $request->id)->update($data);

        // Eloquent ORM System
        $subcategory = Subcategory::where('id', $request->id)->first();
        $subcategory->update([
            'category_id'       => $request->category_id,
            'subcategory_name'  =>$request->subcategory_name,
            'subcategory_slug'  =>Str::slug($request->subcategory_name, '-'),
        ]);

        $notification=array('messege' => 'Subcategory Updated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
        
    }

    // Subcategory delete Method
    public function destroy($id)
    {
        DB::table('subcategories')->where('id', $id)->delete();

        $notification=array('messege' => 'Subcategory Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


}
