<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        }else if($request->shipping_charge=='out_dhaka'){
            $order['shipping_charge']= 150*$cart_qty;
        }else{
            $order['shipping_charge']= 150*$cart_qty;
        }

        if (Session::has('coupon')) {
            $order['subtotal']=Cart::total();
            $order['coupon_code']=Session::get('coupon')['name'];
            $order['coupon_discount']=Session::get('coupon')['discount'];
            $order['after_discount']=(Cart::total()+$cart_qty *100) - (Session::get('coupon')['discount']);
            $order['shipping_charge']= 100*$cart_qty;
        }else{
            $order['subtotal']=Cart::total();            
        }

        $order['payment_type']=$request->payment_type;
        $order['tax']=0;
        $order['order_id']= uniqid().rand(100000, 9000000);
        $order['status']=0;
        $order['date']=date('d-m-Y');
        $order['month']=date('F');
        $order['year']=date('Y');

        $order_id=DB::table('orders')->insertGetId($order);

        
        //____order details
        $content=Cart::content();

        Mail::to($request->c_email)->send(new InvoiceMail($order, $content));

        $details=array();
        foreach($content as $item){
            $details['order_id']=$order_id;
            $details['product_id']=$item->id;
            $details['product_name']=$item->name;
            $details['color']=$item->options->color;
            $details['size']=$item->options->size;
            $details['quantity']=$item->qty;
            $details['single_price']=$item->price;
            $details['subtotal_price']=$item->price*$item->qty;

            DB::table('order_details')->insert($details);
        }

        //___Cart Destroy
        Cart::destroy();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification=array('messege' => 'Successfully Order Place!', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification);

        

    }




}
