@extends('layouts.app')
@section('navbar')
    @include('layouts.front_partial.main_header')
@endsection
@section('content')

<!-- hero slider start -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="slider-wrapper-area">
                <div class="hero-slider-active hero__1 slick-dot-style hero-dot">
                    @foreach ($bannerProduct as $item)
                    <div class="single-slider" style="background-image: url({{ asset('frontend') }}/img/slider/slider11_bg.jpg);">
                        <div class="container p-0">
                            <div class="slider-main-content">
                                <div class="slider-content-img">
                                    <img src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}">
                                </div>
                                <div class="slider-text">                                    
                                    <div class="slider-label">
                                        <img src="{{ asset('frontend') }}/img/slider/slider11_lable4.png" alt="">
                                    </div>
                                    <h3 class="text-white">{{$item->name}}</h3>
                                    <h5 class="text-white my-2">
                                        @if($item->discount_price==null)
                                            <span>Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                        @else
                                            <span>Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                            <span class="badge badge-danger badge-sm" style="text-decoration: line-through;">Price: {{$setting->currency}}{{$item->discount_price}}</span>
                                        @endif
                                    </h5>
                                    <h5 class="text-white my-2">Brand: {{$item->brand->brand_name}}</h5>
                                    <a href="{{route('product.details', $item->slug)}}" class="btn btn-success">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hero slider end -->

<!-- home banner area start -->
<div class="banner-area mt-30 mb-30">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="cus-info d-flex align-items-center justify-content-center" style="gap: 10px;padding:20px 0px">
                        <p style="font-size: 30px"><i class="fa fa-truck"></i></p>
                        <div class="cus-details d-flex flex-column">
                            <strong>Shipping & Returns</strong>
                            <span>Super Fast Delivery</span>
                        </div>
                    </div>                    
                </div>
            </div>  
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="cus-info d-flex align-items-center justify-content-center" style="gap: 10px;padding:20px 0px">
                        <p style="font-size: 30px"><i class="fa fa-suitcase"></i></p>
                        <div class="cus-details d-flex flex-column">
                            <strong>Secure Payment</strong>
                            <span>We ensure secure payment</span>
                        </div>
                    </div>                    
                </div> 
            </div>  
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="cus-info d-flex align-items-center justify-content-center" style="gap: 10px;padding:20px 0px">
                        <p style="font-size: 30px"><i class="fa fa-money"></i></p>
                        <div class="cus-details d-flex flex-column">
                            <strong>Money Back Guarantee</strong>
                            <span>Free 3-day return if eligible</span>
                        </div>
                    </div>                    
                </div> 
            </div>  
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="cus-info d-flex align-items-center justify-content-center" style="gap: 10px;padding:20px 0px">
                        <p style="font-size: 30px"><i class="fa fa-commenting"></i></p>
                        <div class="cus-details d-flex flex-column">
                            <strong>Customer Support</strong>
                            <span>Call or message us 24/7</span>
                        </div>
                    </div>                    
                </div> 
            </div>  
        </div>
    </div>
</div>
<!-- home banner area end -->

<!-- page wrapper start -->
<div class="page-wrapper pt-6 pb-28 pb-md-6 pb-sm-6 pt-xs-36">
    <div class="container">
        <div class="row">
            <!-- start home sidebar -->
            <div class="col-lg-3">
                <div class="home-sidebar">
                    <!-- today deals area start -->
                    <div class="main-sidebar hot-deals-wrap mb-30">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>today deals</h3>
                            <div class="slick-append"></div>
                        </div> <!-- section title end -->
                        <div class="deals-carousel-active slick-padding slick-arrow-style">
                            <!-- product single item start -->
                            @foreach ($todayDeal as $item)                           
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
                                        <img src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}">
                                        {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                    </a>
                                    <div class="product-label">
                                        <span>New</span>
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
                                    @if ($item->stock_quantity==0)
                                        <button data-toggle="tooltip" data-placement="left" title="Out of Stock" class="btn btn-dark btn-sm" disabled><i class="fa fa-shopping-cart"></i></button>    
                                    @else
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>                                        
                                    @endif 
                                    </div>
                                </div>
                                <div class="product-content">  
                                    <span>{{$item->category->category_name}} <i class="fa fa-chevron-right" style="font-size: 11px;color:#555"></i> {{$item->subcategory->subcategory_name}}</span>                              
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
                            <!-- product single item end -->
                        </div>
                    </div>
                    <!-- today deals area end -->

                    <!-- blog area start -->
                    <div class="main-sidebar blog-area mb-24">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>latest blog</h3>
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <!-- blog wrapper start -->
                        <div class="blog-carousel-active">
                            <div class="blog-item">
                                <div class="blog-thumb img-full fix">
                                    <a href="blog-details.html">
                                        <img src="{{ asset('frontend') }}/img/blog/img_blog1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <h3><a href="blog-details.html">post format audio</a></h3>
                                    <div class="blog-meta">
                                        <span class="posted-author">by: admin</span>
                                        <span class="post-date">25 Nov, 2018</span>
                                    </div>
                                    <p>Curabitur sed diam enim. Sed varius faucibus lectus, a scelerisque massa
                                        posuere ac. Quisque dapibus, est ac...</p>
                                </div>
                                <a href="blog-details.html">read more <i class="fa fa-long-arrow-right"></i></a>
                            </div> <!-- end single blog item -->
                            <div class="blog-item">
                                <div class="blog-thumb img-full fix">
                                    <a href="blog-details.html">
                                        <img src="{{ asset('frontend') }}/img/blog/img_blog2.jpg" alt="">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <h3><a href="blog-details.html">post format image</a></h3>
                                    <div class="blog-meta">
                                        <span class="posted-author">by: admin</span>
                                        <span class="post-date">25 Nov, 2018</span>
                                    </div>
                                    <p>Curabitur sed diam enim. Sed varius faucibus lectus, a scelerisque massa
                                        posuere ac. Quisque dapibus, est ac...</p>
                                </div>
                                <a href="blog-details.html">read more <i class="fa fa-long-arrow-right"></i></a>
                            </div> <!-- end single blog item -->
                        </div>
                        <!-- blog wrapper end -->
                    </div>
                    <!-- blog area end -->

                    <!-- testimonial area start -->
                    <div class="main-sidebar testimonial-area pb-sm-70">
                        <div class="section-title-2 mb-28">
                            <h3>Best Product Review</h3>
                        </div> <!-- section title end -->                        
                        <div class="testimonial-carousel-active slick-dot-style">                            
                            @foreach ($reviews as $rev)                            
                            @php
                                $user=DB::table('users')->where('id', $rev->user_id)->get();
                                $product=DB::table('products')->where('id', $rev->product_id)->get();
                            @endphp 
                            <div class="client-review d-flex flex-column text-center align-items-center">
                                <div class="client-product-photo">
                                    @foreach ($product as $clipro)
                                        <img style="border-radius: 5px" src="{{url('storage/products/' .$clipro -> thumbnail)}}" alt="{{$clipro->name}}" height="150px">                                        
                                    @endforeach
                                </div>
                                <div class="client-product-details my-3">
                                    @foreach ($user as $item)
                                    <strong>{{$item->name}}</strong>
                                    @endforeach
                                    <p>Samsung Galaxy S20FE</p>
                                    <div class="client-rating-date d-flex justify-content-center">
                                        @if ($rev->rating)
                                        <div class="ratings d-block" data-toggle="tooltip" title="5.00" style="letter-spacing: 0px" >
                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                            <span class="four_star"><i class="fa fa-star"></i></span>
                                            <span class="five_star"><i class="fa fa-star"></i></span>
                                        </div>
                                        @endif
                                        <p> {{date('d F, Y'), strtotime($rev->review_date)}}</p>
                                    </div>
                                    <hr>
                                    <p>{{ substr($rev->review,0,100) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- testimonial area end -->

                </div>
            </div>
            <!-- end home sidebar -->

            <div class="col-lg-9">
                <!-- featured category area start -->
                <div class="feature-category-area mt-md-70">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <h3>featured</h3>
                    </div> <!-- section title end -->
                    <!-- featured category start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        <!-- product single item start -->
                        @foreach ($featuredProduct as $item)  
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
                                    <img src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}">
                                    {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                </a>
                                <div class="product-label">
                                    <span>New</span>
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
                                    @if ($item->stock_quantity==0)
                                        <button data-toggle="tooltip" data-placement="left" title="Out of Stock" class="btn btn-dark btn-sm" disabled><i class="fa fa-shopping-cart"></i></button>    
                                    @else
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>                                        
                                    @endif 
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
                    </div>
                    <!-- featured category end -->
                </div>
                <!-- featured category area end -->

                <!-- banner statistic start -->
                <div class="banner-statistic pt-28 pb-36">
                    <div class="img-container fix img-full">
                        <a href="#">
                            <img src="{{ asset('frontend') }}/img/banner/banner_static1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <!-- banner statistic end -->

                <!-- trendy product area start -->
                <div class="feature-category-area">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-flask"></i>
                        </div>
                        <h3>Trendy Product</h3>
                    </div> <!-- section title end -->
                    <!-- trendy product start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        <!-- product single item start -->
                        @foreach ($trendyProduct as $item)
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
                                    <img src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}">
                                    {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                </a>
                                <div class="product-label">
                                    <span>New</span>
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
                                    @if ($item->stock_quantity==0)
                                        <button data-toggle="tooltip" data-placement="left" title="Out of Stock" class="btn btn-dark btn-sm" disabled><i class="fa fa-shopping-cart"></i></button>    
                                    @else
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>                                        
                                    @endif 
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
                        <!-- product single item end -->
                    </div>
                    <!-- trendy product end -->
                </div>
                <!-- trendy product area end -->

                <!-- Random product area start -->
                <div class="feature-category-area">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-flask"></i>
                        </div>
                        <h3>Random Product</h3>
                    </div> <!-- section title end -->
                    <!-- trendy product start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        <!-- product single item start -->
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
                                    <img src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}">
                                    {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                </a>
                                <div class="product-label">
                                    <span>New</span>
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
                                    @if ($item->stock_quantity==0)
                                        <button data-toggle="tooltip" data-placement="left" title="Out of Stock" class="btn btn-dark btn-sm" disabled><i class="fa fa-shopping-cart"></i></button>    
                                    @else
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>                                        
                                    @endif 
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
                        <!-- product single item end -->
                    </div>
                    <!-- trendy product end -->
                </div>
                <!-- Random product area end -->
                
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->

<!-- Top categories area start -->
<div class="brand-area pt-28 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-30">
                    <div class="title-icon">
                        <i class="fa fa-crop"></i>
                    </div>
                    <h3>Top Categories</h3>
                </div> <!-- section title end -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="brand-active slick-padding slick-arrow-style">
                    @foreach ($home_category as $item)
                    <div class="brand-item text-center">
                        <div class="top-category-img d-flex flex-column" style="padding: 10px 0px;cursor: pointer;">
                            <a href="{{route('categorywise.product',$item->id)}}"><img src="{{url('storage/categories/' .$item -> icon)}}" alt="{{$item->category_name}}" width="40px"></a>
                            <strong>{{ substr($item->category_name,0,20) }}</strong>
                        </div>
                        </div>
                    @endforeach                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Categories area end -->

<!-- latest product start -->
<div class="latest-product">
    <div class="container">
        <div class="section-title mb-30">
            <div class="title-icon">
                <i class="fa fa-flash"></i>
            </div>
            <h3>Popolar product</h3>
        </div> <!-- section title end -->
        <!-- Popular product start -->
        <div class="latest-product-active slick-padding slick-arrow-style">
            <!-- Popular product item start -->
            @foreach ($popularProduct as $item) 
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
                        @if ($item->stock_quantity==0)
                            <button data-toggle="tooltip" data-placement="left" title="Out of Stock" class="btn btn-dark btn-sm" disabled><i class="fa fa-shopping-cart"></i></button>    
                        @else
                            <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>                                        
                        @endif 
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

<!-- product Category start -->
@foreach ($home_category as $item)
@php
    $cat_product=DB::table('products')->where('category_id', $item->id)->orderBy('id', 'DESC')->take(24)->get()
@endphp
<div class="latest-product my-5">
    <div class="container">
        <div class="section-title mb-30">
            <div class="title-icon">
                <i class="fa fa-flash"></i>
            </div>
            <h3>{{$item->category_name}}</h3>
        </div> <!-- section title end -->
        <!-- Popular product start -->
        <div class="latest-product-active slick-padding slick-arrow-style">
            <!-- Popular product item start -->
            @foreach ($cat_product as $item) 
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
                        @if ($item->stock_quantity==0)
                            <button data-toggle="tooltip" data-placement="left" title="Out of Stock" class="btn btn-dark btn-sm" disabled><i class="fa fa-shopping-cart"></i></button>    
                        @else
                            <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>                                        
                        @endif 
                    </div>
                </div>
                <div class="product-content">
                    <h4><a href="{{route('product.details', $item->slug)}}">{{ substr($item->name,0,20) }}..</a></h4>
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
@endforeach
<!-- product Category end -->

<!-- brand area start -->
<div class="brand-area pt-28 pb-30">
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
                    @foreach ($brand as $item)                    
                    <div class="brand-item text-center">
                        <a href="{{route('brandwise.product',$item->id)}}"><img src="{{url('storage/brands/' .$item -> brand_logo)}}" alt="{{$item->brand_name}}" width="100%"></a>
                    </div>                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand area end -->


 <!-- Client Say start -->
 <div class="latest-product">
    <div class="container">
        <div class="title-box text-center mb-10">
            <h3>Client Say</h3>
        </div>
        <!-- featured category start -->
        <div class="client-say-active slick-padding slick-arrow-style mb-30">
            <!-- product single item start -->
            @foreach ($website_rev as $item)     
            <div class="product-item fix">
                <div class="product-content">
                    <div class="card-group" style="width: 90%;min-height:450px!important">
                    <div class="card">
                        <div class="card-header client-img text-center">
                            <img class="m-auto card-img-top" src="{{asset('frontend')}}/avatar.jpg" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ substr($item->name,0,50) }}</h5>
                            <p class="card-text">{{ substr($item->review,0,200) }}...</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span>{{$item->review_date}}</span>
                            @if($item->rating==5)
                            <div class="ratings" data-toggle="tooltip" title="5.00" >
                                <span class="one_star"><i class="fa fa-star"></i></span>
                                <span class="two_star"><i class="fa fa-star"></i></span>
                                <span class="three_star"><i class="fa fa-star"></i></span>
                                <span class="four_star"><i class="fa fa-star"></i></span>
                                <span class="five_star"><i class="fa fa-star"></i></span>
                            </div>
                            @elseif($item->rating==4)
                            <div class="ratings" data-toggle="tooltip" title="4.00" >
                                <span class="one_star"><i class="fa fa-star"></i></span>
                                <span class="two_star"><i class="fa fa-star"></i></span>
                                <span class="three_star"><i class="fa fa-star"></i></span>
                                <span class="four_star"><i class="fa fa-star"></i></span>
                                <span><i class="fa fa-star"></i></span>
                            </div>
                            @elseif($item->rating==3)
                            <div class="ratings" data-toggle="tooltip" title="3.00" >
                                <span class="one_star"><i class="fa fa-star"></i></span>
                                <span class="two_star"><i class="fa fa-star"></i></span>
                                <span class="three_star"><i class="fa fa-star"></i></span>
                                <span><i class="fa fa-star"></i></span>
                                <span><i class="fa fa-star"></i></span>
                            </div>
                            @elseif($item->rating==2)
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
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- product single item end -->
        </div>
        <!-- featured category end -->
    </div>
</div>
<!-- Client Say end -->



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
