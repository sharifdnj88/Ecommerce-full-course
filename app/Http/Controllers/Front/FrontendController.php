<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    // Frontend Home Page Method
    public function home()
    {
        $category=DB::table('categories')->get();
        $website_rev=DB::table('webreviews')->where('status',1)->orderBy('id','DESC')->take(16)->get();

        $bannerProduct=Product::where('status',1)->where('product_slider',1)->orderBy('id', 'DESC')->take(5)->get(); 
        $featuredProduct=Product::where('status',1)->where('featured',1)->orderBy('id', 'DESC')->take(20)->get(); 

        $todayDeal=Product::where('status',1)->where('today_deal',1)->orderBy('id', 'DESC')->take(6)->get(); 
        $popularProduct=Product::where('status',1)->orderBy('product_views', 'DESC')->take(16)->get(); 
        $trendyProduct=Product::where('status',1)->where('trendy',1)->orderBy('id', 'DESC')->take(20)->get();
        $randomProduct=Product::where('status',1)->inRandomOrder()->take(20)->get(); 
        $home_category=DB::table('categories')->where('home_page',1)->orderBy('category_name', 'ASC')->get();
        $reviews=DB::table('reviews')->where('rating',5)->orderBy('id', 'DESC')->take(5)->get();
        $brand=DB::table('brands')->where('front_page',1)->inRandomOrder()->take(30)->get();

        $orders=DB::table('orders')->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
        $total_order=DB::table('orders')->where('user_id', Auth::id())->count();
        $complete_order=DB::table('orders')->where('user_id', Auth::id())->where('status',3)->count();
        $cancel_order=DB::table('orders')->where('user_id', Auth::id())->where('status',5)->count();
        $return_order=DB::table('orders')->where('user_id', Auth::id())->where('status',4)->count();

        $ticket=DB::table('tickets')->where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();

        return view('frontend.index', compact('category','bannerProduct','featuredProduct','todayDeal','popularProduct','trendyProduct','home_category','brand','reviews','randomProduct','website_rev','orders','total_order','complete_order','cancel_order','return_order','ticket'));
    }

    // Product Details Method
    public function productDetails($slug)
    {
        $product=DB::table('products')->where('slug', $slug)->first();
                 DB::table('products')->where('slug', $slug)->increment('product_views');

        $cat=DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                ->select('categories.category_name', 'products.*')->where('slug', $slug)->first();

        $subcat=DB::table('products')->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->select('subcategories.subcategory_name', 'products.*')->where('slug', $slug)->first();

        $brand=DB::table('products')->leftJoin('brands', 'products.brand_id', 'brands.id')
                ->select('brands.*', 'products.*')->where('slug', $slug)->first();

        $pick_point=DB::table('products')->leftJoin('pickup_points', 'products.pickup_point_id', 'pickup_points.id')
                ->select('pickup_points.*', 'products.*')->where('slug', $slug)->first();

        $category=DB::table('categories')->get();

        $brands=DB::table('brands')->get();

        // Related Product
        $related_product=DB::table('products')->where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->take(10)->get();

        // Review Show
        $reviews=Review::where('product_id', $product->id)->orderBy('id', 'DESC')->get();

        return view('frontend.product.product_details', compact('product', 'category', 'cat','subcat', 'brand', 'pick_point', 'related_product', 'reviews','brands'));
    }


    // Product Quick View
    public function productQuickView($id)
    {
        $product=Product::where('id', $id)->first();
        return view('frontend.product.quick_view', compact('product'));
    }     

    // Category Wise Product
    public function categoryWiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('category_id',$id)->paginate(60);
        $randomProduct =Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.category_product', compact('products','brands','subcategory','randomProduct','category'));
    }

    // Category Wise Product
    public function SubcategoryWiseProduct($id)
    {
        $subcategory=DB::table('subcategories')->where('id',$id)->first();
        $childcategory=DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('subcategory_id',$id)->paginate(60);
        $randomProduct =Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.subcategory_product', compact('products','brands','subcategory','randomProduct','childcategory'));
    }

    //childcategory product
    public function ChildcategoryWiseProduct($id)
    {
        $childcategory=DB::table('childcategories')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('childcategory_id',$id)->paginate(60);
        $randomProduct =Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.childcategory_product',compact('categories','brands','products','randomProduct','childcategory'));
    }

    //brandwise product
    public function BrandWiseProduct($id)
    {
        $brand=DB::table('brands')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('brand_id',$id)->paginate(60);
        $randomProduct=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.brandwise_product',compact('categories','brands','products','randomProduct','brand'));
    }


    //_____Footer page view method
    public function FooterPage($id)
    {
        $page=DB::table('pages')->where('id',$id)->first();
        return view('layouts.footer.edit',compact('page'));
    }

    //_________News Letter Method
    public function NewsLetter(Request $request)
    {
        $email=$request->email;

        if ($email=='') {
            return response()->json('Email is required!');
        }

        $check=DB::table('newsletters')->where('email', $email)->first();
        if ($check) {
            return response()->json('Email already exists');
        }else{
            $data=array();
            $data['email']=$email;
            DB::table('newsletters')->insert($data);
            return response()->json('Thanks for subscribe');
        }
    }




}
