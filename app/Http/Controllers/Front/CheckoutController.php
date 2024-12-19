<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //_________Checkout all Data
    public function Checkout()
    {
        if (!Auth::check()) {
            $notification=array('messege' => 'Please Login!', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }else{
            $content=Cart::content();
            return view('frontend.cart.checkout', compact('content'));
        }
    }

    //__________Shipping Charge Method
    public function shippingCharge($charge)
    {
        $count=Cart::count();
        $total=Cart::total();
        $data = ($charge * $count)+$total;
        return response()->json($data);
    }

    //________Coupon Store method
    public function CouponApply(Request $request)
    {
        $check=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($check) {
            //__coupon exist
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                 session::put('coupon',[
                    'name'=>$check->coupon_code,
                    'discount'=>$check->coupon_amount,
                    'after_discount'=>Cart::subtotal()-$check->coupon_amount
                 ]);
                 $notification=array('messege' => 'Coupon Applied!', 'alert-type' => 'success');
                 return redirect()->back()->with($notification);
            }else{
               $notification=array('messege' => 'Expired Coupon Code!', 'alert-type' => 'error');
               return redirect()->back()->with($notification);
            }
        }else{
             $notification=array('messege' => 'Invalid Coupon Code! Try again.', 'alert-type' => 'error');
             return redirect()->back()->with($notification);
        }
    }


    //__remove coupon__
    public function RemoveCoupon()
    {
         Session::forget('coupon');
         $notification=array('messege' => 'Coupon removed!', 'alert-type' => 'success');
         return redirect()->back()->with($notification);
    }

    //_______Order Place
    public function OrderPlace(Request $request)
    {
        $order=array();
        $cart_qty=Cart::count();
        $order['user_id']=Auth::id();
        $order['c_name']=$request->c_name;
        $order['c_phone']=$request->c_phone;
        $order['c_email']=$request->c_email;
        $order['c_address']=$request->c_address;
        $order['c_city']=$request->c_city;
        $order['c_extra_phone']=$request->c_extra_phone;
        $order['c_country']=$request->c_country;
        $order['c_zipcode']=$request->c_zipcode;

        if ($request->shipping_charge=='in_dhaka') {
            $order['shipping_charge']= 100*$cart_qty;
        }elseif($request->shipping_charge=='out_dhaka'){
            $order['shipping_charge']= 150*$cart_qty;
        }else{
            $order['shipping_charge']= 150*$cart_qty;
        }

        if (Session::has('coupon')) {
            # code...
        }

        $order['subtotal']=Cart::subtotal();
        $order['total']=$request->c_name;
    }




}
