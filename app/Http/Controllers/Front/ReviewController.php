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

    // ________________Review Store Method
    public function store(Request $request)
    {  
        
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

    // ________________Website Review Store Method
    public function WebsiteReview(Request $request)
    {
        if ($request->review=='' || $request->rating=='' ) {
            return response()->json('All fields are required!'); 
        }
        
        $check=DB::table('webreviews')->where('user_id',Auth::id())->first();

        if ($check) {
            return response()->json('Review already exist!');   
         }
 
         $data=array();
         $data['user_id']=Auth::id();
         $data['name']=$request->name;
         $data['review']=$request->review;
         $data['rating']=$request->rating;
         $data['review_date']=date('d , F Y');
         $data['status']=0;
         DB::table('webreviews')->insert($data);
         return response()->json('Thank for your review !'); 


    }




}
