<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class cartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product=DB::table('products')->where('id', $request->id)->first();

        Cart::add([
            'id'      => $product->id, 
            'name'    => $product->name, 
            'qty'     => $request->qty, 
            'price'   => $request->price, 
            'weight'  => 1, 
            'options' => ['size' => $request->size, 'color' => $request->color,         
                        'thumbnail' => $product->thumbnail]]);

        return response()->json('Product add on Cart!');
    }

    //all cart
    public function AllCart()
    {
        // $cart=DB::table('carts')->where('rowId', Auth::id())->first();
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        // $data['cart_qty']=$cart->count();
        // $data['cart_total']=$cart->total();
        return response()->json($data);
    }


    // My Cart Method
    public function myCart()
    {
        $content=Cart::content();
        // return response()->json($content);
        $brand=DB::table('brands')->where('front_page',1)->inRandomOrder()->take(30)->get();
        return view('frontend.cart.cart', compact('content','brand'));
    }

    public function deletefromcart(Request $request)
    {
        $prod_id = $request->input('product_id');
        Cart::remove($prod_id);
        return response()->json(['status'=>'Item Removed from Cart']);
        

       
    }




}
