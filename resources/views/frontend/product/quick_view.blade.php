<style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #d8373e;
      width: 30px;
      height: 30px;
      margin-left: 45%;
      margin-top: 15%;
      margin-bottom: 18%;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }
    
    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    
</style>
@php
    $gallery_photo = json_decode($product -> images);
    $colors=explode(',',$product->color);
    $sizes=explode(',',$product->size);
@endphp

@php
    $review_5=App\Models\Review::where('product_id',$product->id)->where('rating',5)->count();
    $review_4=App\Models\Review::where('product_id',$product->id)->where('rating',4)->count();
    $review_3=App\Models\Review::where('product_id',$product->id)->where('rating',3)->count();
    $review_2=App\Models\Review::where('product_id',$product->id)->where('rating',2)->count();
    $review_1=App\Models\Review::where('product_id',$product->id)->where('rating',1)->count();

    $sum_rating=App\Models\Review::where('product_id',$product->id)->sum('rating');
    $count_rating=App\Models\Review::where('product_id',$product->id)->count('rating');
    $total_review=App\Models\Review::where('product_id',$product->id)->count('review');

    // $average=$sum_rating/$count_rating;
@endphp

{{-- preloader for product quick view --}}
<div class="loader"></div>

<!-- product details inner end -->
<div class="product-details-inner product_view d-none">
    <div class="row">
        <div class="col-lg-5">
            <div class="product-large-slider slick-arrow-style_2 mb-20">
                <div class="pro-large-img">
                    <img src="{{url('storage/products/' .$product -> thumbnail)}}" alt="{{$product->name}}" />
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="product-details-des mt-md-34 mt-sm-34">
                <h3><a href="#">{{ substr($product->name,0,50) }}</a></h3>
                <div class="ratings">
                    @if($sum_rating !=null)
                    @if(intval($sum_rating/$count_rating) >= 5)
                    <div class="ratings" data-toggle="tooltip" title="5.00" >
                        <span class="one_star"><i class="fa fa-star"></i></span>
                        <span class="two_star"><i class="fa fa-star"></i></span>
                        <span class="three_star"><i class="fa fa-star"></i></span>
                        <span class="four_star"><i class="fa fa-star"></i></span>
                        <span class="five_star"><i class="fa fa-star"></i></span>
                        <span class="ratings-count">({{$total_review}} Reviews)</span>
                    </div>
                    @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
                    <div class="ratings" data-toggle="tooltip" title="4.00" >
                        <span class="one_star"><i class="fa fa-star"></i></span>
                        <span class="two_star"><i class="fa fa-star"></i></span>
                        <span class="three_star"><i class="fa fa-star"></i></span>
                        <span class="four_star"><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span class="ratings-count">({{$total_review}} Reviews)</span>
                    </div>
                    @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
                    <div class="ratings" data-toggle="tooltip" title="3.00" >
                        <span class="one_star"><i class="fa fa-star"></i></span>
                        <span class="two_star"><i class="fa fa-star"></i></span>
                        <span class="three_star"><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span class="ratings-count">({{$total_review}} Reviews)</span>
                    </div>
                    @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
                    <div class="ratings" data-toggle="tooltip" title="2.00" >
                        <span class="one_star"><i class="fa fa-star"></i></span>
                        <span class="two_star"><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span class="ratings-count">({{$total_review}} Reviews)</span>
                    </div>
                    @else
                    <div class="ratings" data-toggle="tooltip" title="1.00" >
                        <span class="one_star"><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span class="ratings-count">({{$total_review}} Reviews)</span>
                    </div>
                    @endif 
                    @else
                    <div class="ratings" data-toggle="tooltip" title="0.00" >
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span><i class="fa fa-star"></i></span>
                        <span class="ratings-count">(0 Reviews)</span>
                    </div>
                    @endif 
                </div>
                <div class="availability mt-10">
                    @if ($product->stock_quantity > 0)
                        <h5>Availability:</h5>
                        <span>{{$product->stock_quantity}} in stock</span>
                    @else
                        <h5>Availability:</h5>
                        <span class="text-danger">Out of Stock</span>
                    @endif                    
                </div>
                <form action="{{route('add.to.cart')}}" method="POST" id="add_cart_form">
                @csrf
                <input name="id" type="hidden" value="{{$product->id}}">
                @if ($product->discount_price==null)
                    <input name="price" type="hidden" value="{{$product->selling_price}}">
                @else
                    <input name="price" type="hidden" value="{{$product->discount_price}}">
                @endif
                <div class="pricebox">
                    @if($product->discount_price==null)
                        <span>Price: {{$setting->currency}}{{$product->selling_price}}</span>
                    @else
                    <span>Price: {{$setting->currency}}{{$product->discount_price}}</span>
                    <span class="badge badge-danger badge-sm" style="text-decoration: line-through;">Price: {{$setting->currency}}{{$product->selling_price}}</span>
                    @endif
                </div>
                {{-- <p>{!! Str::of( htmlspecialchars_decode( $product->description ))-> words(20, '...') !!}</p> --}}
                <p>Product Short Description</p>
                <div class="brand-hr"></div>
                <div class="brand-color-size d-flex" style="gap: 20px">
                    <div class="row" style="width: 100%">
                        <div class="col-md-6">
                            @isset($product->color)
                            <div class="form-group d-flex flex-column">
                                <label>Color</label>
                                <select name="color" class="form-control" style="width: 150px">
                                    @foreach ($colors as $item)
                                        <option value="{{$item}}">{{$item}}</option>         
                                    @endforeach
                                </select>
                            </div>
                            @endisset
                        </div>
                        <div class="col-md-6">
                            @isset($product->size)
                            <div class="form-group d-flex flex-column">
                                <label>Size</label>
                                <select name="size" class="form-control" style="width: 150px">
                                    @foreach ($sizes as $item)
                                        <option value="{{$item}}">{{$item}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            @endisset
                        </div>
                    </div>                                    
                </div>
                <div class="quantity-cart-box d-flex align-items-center mt-20">
                    <div class="quantity">
                        <div class="pro-qty" style="padding:0px 10px">
                            <input name="qty" type="number" value="1" min="1" max="100" class="form-control" style="width: 100%">
                        </div>
                    </div>
                    <div class="action_link w-100 quick-view-button-area">
                        <a href="#" class="buy-btn">
                            <button  type="submit">add to cart<i class="fa fa-shopping-cart" style="background-color: transparent!important"></i></button>
                        </a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- product details inner end -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $('.loader').ready(function() {
      setTimeout(function() {
        $('.product_view').removeClass("d-none");
        $('.loader').css("display", "none");
      }, 500);
    });
    </script>  

<script type="text/javascript">

  //store coupon ajax call
  $('#add_cart_form').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_cart_form')[0].reset();
        cart();
      }
    });
  });  
    
</script>




