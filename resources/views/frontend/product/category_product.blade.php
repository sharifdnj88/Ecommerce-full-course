@extends('layouts.app')
@section('navbar')
@include('layouts.front_partial.collapse_header')    
@endsection
@section('content')

<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">shop</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$category->category_name}}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- page wrapper start -->
<div class="page-main-wrapper">
    <div class="container">
        <div class="row">
            <!-- brand area start -->
            <div class="brand-area pt-4 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title mb-30">
                                <div class="title-icon">
                                    <i class="fa fa-crop"></i>
                                </div>
                                <h3>Popular Brand</h3>
                            </div> <!-- section title end -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="brand-active slick-padding slick-arrow-style">
                                @foreach ($brands as $item)                    
                                    <div class="brand-item text-center">
                                        <a href="{{route('brandwise.product',$item->id)}}"><img src="{{url('storage/brands/' .$item -> brand_logo)}}" alt="{{$item->brand_name}}" width="100%" style="height: 50px"></a>
                                    </div>                    
                                @endforeach                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- brand area end -->
            <!-- sidebar start -->
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="shop-sidebar-wrap mt-md-28 mt-sm-28">
                    <!-- sidebar categorie start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-category">
                            <ul>
                                <li class="title"><i class="fa fa-bars"></i>Subcategories</li>
                                @foreach ($subcategory as $item)
                                    <li><a href="{{route('subcategorywise.product',$item->id)}}">{{$item->subcategory_name}}</a></li>                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- sidebar categorie start -->

                    <!-- manufacturer start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>Manufacturers</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <ul>
                                <li><i class="fa fa-angle-right"></i><a href="#">calvin klein</a><span>(10)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">diesel</a><span>(12)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">polo</a><span>(20)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">Tommy Hilfiger</a><span>(12)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">Versace</a><span>(16)</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- manufacturer end -->

                    <!-- pricing filter start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>filter by price</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <div class="price-range-wrap">
                                <div class="price-range" data-min="50" data-max="400"></div>
                                <div class="range-slider">
                                    <form action="#" class="d-flex justify-content-between">
                                        <button class="filter-btn">filter</button>
                                        <div class="price-input d-flex align-items-center">
                                            <label for="amount">Price: </label>
                                            <input type="text" id="amount">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pricing filter end -->

                    <!-- product size start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>size</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <ul>
                                <li><i class="fa fa-angle-right"></i><a href="#">s</a><span>(10)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">m</a><span>(12)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">l</a><span>(20)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">XL</a><span>(12)</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- product size end -->

                    <!-- product tag start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>tags</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <div class="product-tag">
                                <a href="#">camera</a>
                                <a href="#">computer</a>
                                <a href="#">tablet</a>
                                <a href="#">watch</a>
                                <a href="#">smart phones</a>
                                <a href="#">handbag</a>
                                <a href="#">shoe</a>
                                <a href="#">men</a>
                            </div>
                        </div>
                    </div>
                    <!-- product tag end -->
                </div>
            </div>
            <!-- sidebar end -->

            <!-- product main wrap start -->
            <div class="col-lg-9 order-1 order-lg-2">
                
                <!-- product view wrapper area start -->
                <div class="shop-product-wrapper pt-34">
                    <!-- product item start -->
                    <div class="shop-product-wrap grid row">
                        @foreach ($products as $item)   
                        @php
                            $discountedPrice = $item->selling_price - $item->discount_price;
                            $discountPercentage = ceil(($discountedPrice / $item->selling_price) * 100);
                        @endphp
                        @php
                        $review_5=App\Models\Review::where('product_id',$item->id)->where('rating',5)->count();
                        $review_4=App\Models\Review::where('product_id',$item->id)->where('rating',4)->count();
                        $review_3=App\Models\Review::where('product_id',$item->id)->where('rating',3)->count();
                        $review_2=App\Models\Review::where('product_id',$item->id)->where('rating',2)->count();
                        $review_1=App\Models\Review::where('product_id',$item->id)->where('rating',1)->count();

                        $sum_rating=App\Models\Review::where('product_id',$item->id)->sum('rating');
                        $count_rating=App\Models\Review::where('product_id',$item->id)->count('rating');
                        $total_review=App\Models\Review::where('product_id',$item->id)->count('review');
                        @endphp                      
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="product-item fix mb-30">
                                <div class="product-thumb">
                                    <a href="{{route('product.details', $item->slug)}}">
                                        <img src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}">
                                        {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                    </a>
                                    <div class="product-label">
                                        @if ($item->discount_price!=null)
                                            <span>
                                                -{{$discountPercentage}}%
                                            </span>
                                            
                                        @endif
                                    </div>
                                    <div class="product-action-link">
                                        <a href="#" class="quick_view_product" id="{{$item->id}}" data-toggle="modal" data-target="#quick_view"> <span
                                                data-toggle="tooltip" data-placement="left" title="Quick view"><i
                                                    class="fa fa-search"></i></span> </a>                                
                                        <a href="#" class="home-wishlist wishlist_btn_home" data-toggle="tooltip" data-placement="left" title="Wishlist">
                                            <form action="{{route('add.wishlist', $item->id)}}" id="wishlist_btn" method="POST">
                                                @csrf                                            
                                                <button type="submit" class="home-wishlist-btn"><i class="fa fa-heart-o"></i></button>                                            
                                            </form>
                                        </a>                                    
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">                                
                                    <h4><a href="{{route('product.details', $item->slug)}}">{{ substr($item->name,0,10) }}..</a></h4>
                                    <div class="pricebox">
                                        @if($item->discount_price==null)
                                        <span>Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                        @else
                                        <span>Price: {{$setting->currency}}{{$item->discount_price}}</span>                                        
                                        @endif
                                        <div class="ratings">
                                            @if($sum_rating !=null)
                                            @if(intval($sum_rating/$count_rating) >= 5)
                                            <div class="ratings" data-toggle="tooltip" title="5.00" >
                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                <span class="three_star"><i class="fa fa-star"></i></span>
                                                <span class="four_star"><i class="fa fa-star"></i></span>
                                                <span class="five_star"><i class="fa fa-star"></i></span>
                                            </div>
                                            @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
                                            <div class="ratings" data-toggle="tooltip" title="4.00" >
                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                <span class="three_star"><i class="fa fa-star"></i></span>
                                                <span class="four_star"><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                            </div>
                                            @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
                                            <div class="ratings" data-toggle="tooltip" title="3.00" >
                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                <span class="three_star"><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                            </div>
                                            @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
                                            <div class="ratings" data-toggle="tooltip" title="2.00" >
                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                            </div>
                                            @else
                                            <div class="ratings" data-toggle="tooltip" title="1.00" >
                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                            </div>
                                            @endif 
                                            @else
                                            <div class="ratings" data-toggle="tooltip" title="0.00" >
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                            </div>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                        <!-- product single column end -->
                    </div>                    
                    <!-- product item end -->
                </div>
                <!-- product view wrapper area end -->
                
                <!-- start pagination area -->
                <div class="paginatoin-area text-center pt-28">
                    <div class="row">
                        <div class="col-12">
                            <div class="paginator d-flex justify-content-center">
                                {{ $products->links() }}                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end pagination area -->

            </div>
            <!-- product main wrap end -->                       
        </div>
        <div class="row">
             <!-- latest product start -->
             <div class="latest-product">
                <div class="container">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-flash"></i>
                        </div>
                        <h3>Random product</h3>
                    </div> <!-- section title end -->
                    <!-- Popular product start -->
                    <div class="latest-product-active slick-padding slick-arrow-style">
                        <!-- Popular product item start -->
                        @foreach ($randomProduct as $item) 
                        @php
                        $review_5=App\Models\Review::where('product_id',$item->id)->where('rating',5)->count();
                        $review_4=App\Models\Review::where('product_id',$item->id)->where('rating',4)->count();
                        $review_3=App\Models\Review::where('product_id',$item->id)->where('rating',3)->count();
                        $review_2=App\Models\Review::where('product_id',$item->id)->where('rating',2)->count();
                        $review_1=App\Models\Review::where('product_id',$item->id)->where('rating',1)->count();

                        $sum_rating=App\Models\Review::where('product_id',$item->id)->sum('rating');
                        $count_rating=App\Models\Review::where('product_id',$item->id)->count('rating');
                        $total_review=App\Models\Review::where('product_id',$item->id)->count('review');
                        @endphp 
                        <div class="product-item fix shadow mb-30" style="padding: 3px 10px">
                            <div class="product-thumb">
                                <a href="{{route('product.details', $item->slug)}}">
                                    <img src="{{url('storage/products/' .$item -> thumbnail)}}" class="img-pri" alt="{{$item->name}}">
                                    {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                </a>
                                <div class="product-label">
                                    <span>new</span>
                                </div>
                                <div class="product-action-link">
                                    <a href="#" class="quick_view_product" id="{{$item->id}}" data-toggle="modal" data-target="#quick_view"> <span data-toggle="tooltip"
                                            data-placement="left" title="Quick view"><i class="fa fa-search"></i></span>
                                    </a>
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Wishlist">
                                        <form action="{{route('add.wishlist', $item->id)}}" id="wishlist_btn" method="POST">
                                            @csrf                                            
                                            <button type="submit" class="home-wishlist-btn"><i class="fa fa-heart-o"></i></button>                                            
                                        </form>
                                    </a>                        
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{route('product.details', $item->slug)}}">{{ substr($item->name,0,15) }}..</a></h4>
                                <div class="pricebox">
                                    @if($item->discount_price==null)
                                    <span>Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                    @else
                                    <span>Price: {{$setting->currency}}{{$item->discount_price}}</span>
                                    <span class="badge badge-danger badge-sm" style="text-decoration: line-through;">Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                    @endif
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
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Popular product item end -->
                    </div>
                    <!-- Popular product end -->
                </div>
            </div>
            <!-- latest product end -->  
        </div>
    </div>
</div>
<!-- page wrapper end -->


    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="quick_view_body">
                {{-- Data Come from product quick_view --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

    //Wishlist form submit
$(document).on('click', '#wishlist_btn', function(e){ 
  e.preventDefault();
  var url = $(this).attr('action');
  var request =$(this).serialize();
$.ajax({
  url:url,
  type:'post',
  async:false,
  data:request,
  success:function(data){
      if (data=='Please login!') {
          toastr.info(data);
    }
    else if (data=='Already added in wishlist!') {
        toastr.warning(data); 
    }else{
        toastr.success(data);
        wishlist();
    }
  }
});
});  


// Product Quick View
$(document).on('click', '.quick_view_product', function(){  
    var id = $(this).attr('id');
    $.ajax({
            url: "{{ url("/product-quick-view/") }}/"+id,
            type: 'get',
            success: function(data) {
                $("#quick_view_body").html(data);
            }
        });
});  

</script>



@endsection