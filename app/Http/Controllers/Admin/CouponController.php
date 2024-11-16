<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class CouponController extends Controller
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

    // Coupon Home Page Method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('coupons')->latest()->get();
            return FacadesDataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit"></i></a>
                        <a href="'.route('coupon.delete',[$row->id]).'"  class="btn btn-danger btn-sm" id="delete_coupon"><i class="fa fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action'])
                    ->make(true);       
        }

        return view('admin.offer.coupon.index');
    }

    // Coupon Store or Create Method
    public function store(Request $request)
    {
        $coupon=array();
        $coupon['status']=$request->status;
        $coupon['type']=$request->type;
        $coupon['valid_date']=$request->valid_date;
        $coupon['coupon_code']=$request->coupon_code;
        $coupon['coupon_amount']=$request->coupon_amount;

        DB::table('coupons')->insert($coupon);        
        return response()->json('Coupon Inserted!');

    }

    // Coupon Edit Methed
    public function edit($id)
    {
        $edit=DB::table('coupons')->where('id', $id)->first();
        return view('admin.offer.coupon.edit', compact('edit'));
    }

    // Coupon Update Method
    public function update(Request $request)
    {
        $coupon=array();
        $coupon['status']=$request->status;
        $coupon['type']=$request->type;
        $coupon['valid_date']=$request->valid_date;
        $coupon['coupon_code']=$request->coupon_code;
        $coupon['coupon_amount']=$request->coupon_amount;

        DB::table('coupons')->where('id', $request->id)->update($coupon);        
        return response()->json('Coupon Update!');
    }

    // Coupon Delete Method
    public function destroy($id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        return response()->json('Coupon deleted!');
    }




}
