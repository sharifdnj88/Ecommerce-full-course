<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Facades\DB;

class PickupController extends Controller
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

    // Pickup Point Home Page Method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('pickup_points')->latest()->get();
            return FacadesDataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit"></i></a>
                        <a href="'.route('pickup.point.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_coupon"><i class="fa fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action'])
                    ->make(true);       
        }

        return view('admin.pickup_point.index');
    }

    // Pickup Point Store Method
    public function store(Request $request)
    {
        $pick=array();
        $pick['pickup_point_name']=$request->pickup_point_name;
        $pick['pickup_point_address']=$request->pickup_point_address;
        $pick['pickup_point_phone']=$request->pickup_point_phone;
        $pick['pickup_point_phone_two']=$request->pickup_point_phone_two;

        DB::table('pickup_points')->insert($pick);        
        return response()->json('Pickup Point Inserted!');

    }

    // Pickup Point Edit Methed
    public function edit($id)
    {
        $edit=DB::table('pickup_points')->where('id', $id)->first();
        return view('admin.pickup_point.edit', compact('edit'));
    }

    // Pickup Point Update Method
    public function update(Request $request)
    {
        $pick=array();
        $pick['pickup_point_name']=$request->pickup_point_name;
        $pick['pickup_point_address']=$request->pickup_point_address;
        $pick['pickup_point_phone']=$request->pickup_point_phone;
        $pick['pickup_point_phone_two']=$request->pickup_point_phone_two;

        DB::table('pickup_points')->where('id', $request->id)->update($pick);        
        return response()->json('Pickup Point Update!');
    }

    // Pickup Point Delete Method
    public function destroy($id)
    {
        DB::table('pickup_points')->where('id',$id)->delete();
        return response()->json('Pickup Point deleted!');
    }





}
