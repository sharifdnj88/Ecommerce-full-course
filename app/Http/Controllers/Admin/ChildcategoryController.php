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
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=DB::table('childcategories')->leftjoin('categories', 'childcategories.category_id','categories.id')->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')->select('categories.category_name', 'subcategories.	subcategory_name', 'childcategories.*')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addCloumn('action', function($row){
                        $actionbtn='
                        <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $row->id }}"   data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>
                        <a href="#" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>';

                        return $actionbtn;

                    })
                    ->rowColumns(['action'])
                    ->make(true);                    
                }

            return view('admin.category.childcategory.index');
    }


}
