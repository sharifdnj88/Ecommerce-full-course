<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class warehouseController extends Controller
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

    // Warehouse Home Page Method
    public function index()
    {
        $warehouse=DB::table('warehouses')->get();
        return view('admin.category.warehouse.index', compact('warehouse'));
    }

    // Warehouse Store or Create Method
    public function store(Request $request)
    {
        $warehouse=array();
        $warehouse['warehouse_name']=$request->warehouse_name;
        $warehouse['warehouse_phone']=$request->warehouse_phone;
        $warehouse['warehouse_address']=$request->warehouse_address;

        DB::table('warehouses')->insert($warehouse);

        $notification=array('messege' => 'Warehouse Inserted successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Warehouse Delete Method
    public function edit($id)
    {
        $edit=DB::table('warehouses')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('edit'));
    }

    // Warehouse Delete Method
    public function update(Request $request)
    {
        $warehouse=array();
        $warehouse['warehouse_name']=$request->warehouse_name;
        $warehouse['warehouse_phone']=$request->warehouse_phone;
        $warehouse['warehouse_address']=$request->warehouse_address;

        DB::table('warehouses')->where('id', $request->id)->update($warehouse);

        $notification=array('messege' => 'Warehouse Update successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Warehouse Delete Method
    public function destroy($id)
    {
        DB::table('warehouses')->where('id', $id)->delete();

        $notification=array('messege' => 'Warehouse Delete successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


}
