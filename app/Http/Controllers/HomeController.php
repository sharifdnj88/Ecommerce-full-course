<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category=DB::table('categories')->get();

        $bannerProduct=Product::where('product_slider',1)->take(5)->get(); 
        $featuredProduct=Product::where('featured',1)->orderBy('id', 'DESC')->take(5)->get(); 
        return view('frontend.index', compact('category','bannerProduct','featuredProduct'));
    }

    // Customer Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

    
}
