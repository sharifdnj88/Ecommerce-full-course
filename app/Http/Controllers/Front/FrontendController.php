<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    // Frontend Home Page Method
    public function home()
    {
        $category=DB::table('categories')->get();

        // $bannerProduct=DB::table('products')->where('product_slider',1)->take(5)->get(); 
        $bannerProduct=Product::where('product_slider',1)->take(5)->get(); 
        return view('frontend.index', compact('category','bannerProduct'));
    }

    // Product Details Method
    public function productDetails($slug)
    {
        $product=DB::table('products')->where('slug', $slug)->first();
        $cat=DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                ->select('categories.category_name', 'products.*')->where('slug', $slug)->first();

        $subcat=DB::table('products')->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->select('subcategories.subcategory_name', 'products.*')->where('slug', $slug)->first();

        $brand=DB::table('products')->leftJoin('brands', 'products.brand_id', 'brands.id')
                ->select('brands.*', 'products.*')->where('slug', $slug)->first();

        $category=DB::table('categories')->get();
        return view('frontend.product_details', compact('product', 'category', 'cat','subcat', 'brand'));
    }

}
