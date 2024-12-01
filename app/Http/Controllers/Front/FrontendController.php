<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    // Frontend Home Page Method
    public function home()
    {
        $category=DB::table('categories')->get();

        // $bannerProduct=DB::table('products')->where('product_slider',1)->take(5)->get(); 
        $bannerProduct=Product::where('product_slider',1)->orderBy('id', 'DESC')->take(5)->get(); 
        return view('frontend.index', compact('category','bannerProduct'));
    }

    // Product Details Method
    public function productDetails($slug)
    {
        $product=DB::table('products')->where('slug', $slug)->first();

        // dd($product);

        $cat=DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                ->select('categories.category_name', 'products.*')->where('slug', $slug)->first();

        $subcat=DB::table('products')->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->select('subcategories.subcategory_name', 'products.*')->where('slug', $slug)->first();

        $brand=DB::table('products')->leftJoin('brands', 'products.brand_id', 'brands.id')
                ->select('brands.*', 'products.*')->where('slug', $slug)->first();

        $pick_point=DB::table('products')->leftJoin('pickup_points', 'products.pickup_point_id', 'pickup_points.id')
                ->select('pickup_points.*', 'products.*')->where('slug', $slug)->first();

        $category=DB::table('categories')->get();

        // Related Product
        $related_product=DB::table('products')->where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->take(10)->get();

        // Review Show
        $reviews=Review::where('product_id', $product->id)->orderBy('id', 'DESC')->get();

        return view('frontend.product_details', compact('product', 'category', 'cat','subcat', 'brand', 'pick_point', 'related_product', 'reviews'));
    }

}
