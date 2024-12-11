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


    // Update Cart quantity data without page reload
    public function updatetocart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = $request->input('qty');
        
        Cart::update($prod_id, ['qty' => $quantity]);
        return response()->json(['status'=>'Cart quantity Updateed!']);
        
    }

    // Update Cart color data without page reload
    public function updateCartColor(Request $request)
    {
        $color_id = $request->input('color_id');
        $color = $request->input('color');
        $product=Cart::get($color_id);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;

        Cart::update($color_id, ['options'  => ['color' => $color, 'thumbnail' => $thumbnail, 'size' => $size]]);        
        return response()->json(['status'=>'Product Color Updated!']);
        
    }

    // Update Cart Size data without page reload
    public function updateCartSize($rowId,$size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId, ['options'  => ['size' => $size , 'thumbnail'=>$thumbnail ,'color'=>$color]]);
        return response()->json('Product Size Updated!');
        
    }

    // Delete Cart data without page reload
    public function deletefromcart(Request $request)
    {
        $prod_id = $request->input('product_id');
        Cart::remove($prod_id);
        return response()->json(['status'=>'Item Removed from Cart']);
       
    }

    // All Cart Item Remove
    public function cartEmpty()
    {
        Cart::destroy();
        $notification=array('messege' => 'Cart item clear', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification); 
    }




}
