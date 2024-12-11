<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
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

    // Review Store Method
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'review' => 'required',
        //     'rating' => 'required',
        // ]);     
        
        if ($request->review=='' || $request->rating=='' ) {
            return response()->json('All fields are required!'); 
        }
       

        $check=DB::table('reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if ($check) {            
            return response()->json('Already review this product!');        
        }else{
        //query builder
        $data=array();
        $data['user_id']=Auth::id();
        $data['product_id']=$request->product_id;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date("d-m-Y");
        $data['review_month']=date('F');
        $data['review_year']=date('Y');
        DB::table('reviews')->insert($data);

        return response()->json('Thanks for your Review!');
        }

    }




}
