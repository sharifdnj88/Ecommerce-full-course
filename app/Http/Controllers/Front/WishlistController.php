<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{

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
            $data['date']=date("d-m-Y");
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




}
