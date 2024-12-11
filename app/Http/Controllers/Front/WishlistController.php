<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    // Wishlist Page
    public function WishlistPage()
    {
        if (Auth::check()) {
            $wishlist=DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.*','wishlists.*')->where('wishlists.user_id',Auth::id())->get();
            $brand=DB::table('brands')->where('front_page',1)->inRandomOrder()->take(30)->get();
            return view('frontend.cart.wishlist',compact('wishlist','brand'));
        } else {
            $notification=array('messege' => 'Please login first', 'alert-type' => 'info');
            return redirect()->to('/')->with($notification);
        }
        
    }

    // Wishlist Product Add
    public function addWishlist($id)
    {
        $check=DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();

        if (!Auth::check()) {
            return response()->json('Please login!'); 
        }

        if ($check) {
            return response()->json('Already added in wishlist!'); 
        }else{
            $data=array();
            $data['product_id']=$id;
            $data['user_id']=Auth::id();
            $data['date']=date("d F, Y");
            DB::table('wishlists')->insert($data);
            return response()->json('Product added in Wislist!'); 

        }
    }

    //all cart
    public function AllWishlist()
    {
        $wishlist=DB::table('wishlists')->where('user_id', Auth::id())->count();
        $data=array();
        $data['wishlist_qty']=$wishlist;
        return response()->json($data);
    }

    //One item delete in wishlish
    public function deleteFromWishlist(Request $request)
    {
        $id = $request->input('wishlist_id');
        DB::table('wishlists')->where('id', $id)->delete();
        return response()->json(['status'=>'Item Removed from Wishlist']);
    }


    //all wishlish delete
    public function AllWishlistDestroy()
    {
        DB::table('wishlists')->where('user_id', Auth::id())->delete();
        $notification=array('messege' => 'All Wishlist item removed', 'alert-type' => 'info');
        return redirect()->to('/')->with($notification);
    }




}
