<?php

namespace App\Http\Controllers\Admin;

// use Helpers\Helper;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class productController extends Controller
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

    // Product Home Page Method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='storage/products';

            $product="";
            $query=DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->leftJoin('brands', 'products.brand_id', 'brands.id');

            if ($request->category_id) {
                $query->where('products.category_id',$request->category_id);
             }

            if ($request->brand_id) {
                $query->where('products.brand_id', $request->brand_id);
            }

            if ($request->warehouse) {
                $query->where('products.warehouse', $request->warehouse);
            }

            if ($request->status==1) {
                $query->where('products.status',1);
            }
            if ($request->status==0) {
                $query->where('products.status',0);
            }

            $product=$query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                    ->get();

            return FacadesDataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('thumbnail',function($row) use($imgurl) {
                        return '<img src="'.$imgurl.'/'.$row->thumbnail.'" height="70" width="70">';
                    })                   
                    ->editColumn('featured',function($row){
                        if ($row->featured==1) {
                            return '
                            <a href="#" data-id="'.$row->id.'" class="featured_deactive" style="display:flex;align-items:center;cursor:pointer">
                                <i class="fa fa-window-close-o text-danger mx-2" style="margin-top:-1px;font-size:18px"></i> 
                                <span class="badge badge-success">Active</span>
                            </a>';
                        }else{
                            return '
                            <a href="#" data-id="'.$row->id.'" class="featured_active" style="display:flex;align-items:center;cursor:pointer">
                                <i class="fa fa-check-square-o text-success mx-2" style="margin-top:-1px;font-size:18px"></i> 
                                <span class="badge badge-danger">Inactive</span>
                            </a>';
                        }
                    })
                    ->editColumn('today_deal',function($row){
                        if ($row->today_deal==1) {
                            return '
                            <a href="#" data-id="'.$row->id.'" class="today_deal_deactive" style="display:flex;align-items:center;cursor:pointer">
                                <i class="fa fa-window-close-o text-danger mx-2" style="margin-top:-1px;font-size:18px"></i> <span class="badge badge-success">Active</span>
                            </a>';
                        }else{
                            return '
                            <a href="#" data-id="'.$row->id.'" class="today_deal_active" style="display:flex;align-items:center;cursor:pointer">
                                <i class="fa fa-check-square-o text-success mx-2" style="margin-top:-1px;font-size:18px"></i> 
                                <span class="badge badge-danger">Inactive</span>
                            </a>
                            ';
                        }
                    })
                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '
                            <a href="#" data-id="'.$row->id.'" class="status_deactive" style="display:flex;align-items:center;cursor:pointer">
                                <i class="fa fa-window-close-o text-danger mx-2" style="margin-top:-1px;font-size:18px"></i> <span class="badge badge-success">Active</span>
                            </a>';
                        }else{
                            return '
                            <a href="#" data-id="'.$row->id.'" class="status_active" style="display:flex;align-items:center;cursor:pointer">
                                <i class="fa fa-check-square-o text-success mx-2" style="margin-top:-1px;font-size:18px"></i> 
                                <span class="badge badge-danger">Inactive</span>
                            </a>
                            ';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('product.edit', [$row->id]).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="'.route('product.delete', [$row->id]).'"  class="btn btn-danger btn-sm" id="product_delete"><i class="fa fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','category_name','subcategory_name','brand_name','thumbnail','featured','today_deal','status'])
                    ->make(true);       
        }


        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $warehouse=DB::table('warehouses')->get();

        return view('admin.product.index', compact('category', 'brand', 'warehouse'));
    }

    // Product Featured Deactive
    public function featuredDeactive($id)
    {
        DB::table('products')->where('id', $id)->update(['featured'=>0]);
        return response()->json('Product Featured Deactive');
    }

    // Product Featured Active
    public function featuredActive($id)
    {
        DB::table('products')->where('id', $id)->update(['featured'=>1]);
        return response()->json('Product Featured Active');
    }

    // Product Today deal Deactive
    public function todaydealDeactive($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal'=>0]);
        return response()->json('Product Today Deal Deactive');
    }

    // Product Today Deal Active
    public function todaydealActive($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal'=>1]);
        return response()->json('Product Today Deal Active');
    }

    // Product Status Deactive
    public function statusDeactive($id)
    {
        DB::table('products')->where('id', $id)->update(['status'=>0]);
        return response()->json('Product Status Deactive');
    }

    // Product Status Active
    public function statusActive($id)
    {
        DB::table('products')->where('id', $id)->update(['status'=>1]);
        return response()->json('Product Status Active');
    }

    // Product Create Method
    public function create(Request $request)
    {
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $pickup_point=DB::table('pickup_points')->get();
        $warehouse=DB::table('warehouses')->get();

        return view('admin.product.create', compact('category','brand','pickup_point','warehouse'));

    }
    // Product Home page Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required',
            'subcategory_id'=> 'required',
            'brand_id'      => 'required',
            'unit'          => 'required',
            'selling_price' => 'required',
            'color'         => 'required',
            'description'   => 'required',
        ]);

        $subcategory=DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        // $subcategory->category_id;

        $product_code = Helper::IDGenerator(new Product , 'code', 6, 'D124'); 

        $data=array();
        $data['name']=$request->name;
        $data['slug']=Str::slug($request->name, '-');;
        $data['code']=$product_code;
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_id']=$request->childcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['pickup_point_id']=$request->pickup_point_id;
        $data['unit']=$request->unit;
        $data['tags']=$request->tags;
        $data['video']=$request->video;
        $data['purchase_price']=$request->purchase_price;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;
        $data['stock_quantity']=$request->stock_quantity;
        $data['warehouse']=$request->warehouse;
        $data['description']=$request->description;
        $data['color']=$request->color;
        $data['size']=$request->size;
        $data['featured']=$request->featured;
        $data['product_slider']=$request->product_slider;
        $data['trendy']=$request->trendy;
        $data['today_deal']=$request->today_deal;
        $data['status']=$request->status;
        $data['admin_id']=Auth::id();
        $data['date']=date('d-m-Y');
        $data['month']=date('F');

        // Product Single Thumbnail Upload
        if ($request->thumbnail) {
            $slug=Str::slug($request->name, '-');
            $photo=$request->thumbnail;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,600)->save( storage_path('app/public/products/'). $photoname );
            $data['thumbnail']=$photoname; 
        }

         //multiple images
       $images = array();
       if($request->hasFile('images')){
           foreach ($request->file('images') as $key => $image) {
               $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(600,600)->save( storage_path('app/public/products/').$imageName);
               array_push($images, $imageName);
           }
           $data['images'] = json_encode($images);
       }

       DB::table('products')->insert($data);  

        $notification=array('messege' => 'Product Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);


    }

    // Product Edit Method
    public function edit($id)
    {
        $edit=DB::table('products')->where('id', $id)->first();
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $pickup_point=DB::table('pickup_points')->get();
        $warehouse=DB::table('warehouses')->get();
        $childcategory=DB::table('childcategories')->where('category_id',$edit->category_id)->get();

        return view('admin.product.edit', compact('edit','category','brand','pickup_point','warehouse','childcategory'));
    }

    // Product Delete Method
    public function destroy($id)
    {
        $data=DB::table('products')->where('id', $id)->first();
        DB::table('products')->where('id', $id)->delete();        

        $thumbnail=$data->thumbnail;

        if ($thumbnail) {
            unlink('storage/products/'. $thumbnail);
        }

        $images=json_decode($data->images,true);
        if (isset($images)) {
             foreach($images as $key => $image){                
                unlink('storage/products/'. $image);
             }
        }

        return response()->json('Product Data Deleted');

    }
    


}

