<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
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

    public function shippingCharge($charge)
    {
        $count=Cart::count();
        $total=Cart::total();
        $data = ($charge * $count)+$total;
        return response()->json($data);
    }



}
