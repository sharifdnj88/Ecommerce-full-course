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
                            <li class="breadcrumb-item active" aria-current="page">product details</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
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
@endphp
<!-- product details wrapper start -->
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-large-slider mb-20 slick-arrow-style_2">
                                @foreach ($gallery_photo as $gallery)
                                <div class="pro-large-img img-zoom" id="img1">
                                    <img src="{{url('storage/products/' .$gallery)}}" alt="{{$product->name}}" />
                                </div>                               
                                @endforeach
                            </div>
                            <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                @foreach ($gallery_photo as $gallery)
                                <div class="pro-nav-thumb"><img src="{{url('storage/products/' .$gallery)}}" alt="{{$product->name}}" /></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-des mt-md-34 mt-sm-34">
                                <h3><a href="#">{{$product->name}}</a></h3>
                                <div class="brand d-flex">
                                    <img src="{{url('storage/brands/' .$brand-> brand_logo)}}" alt="{{$brand->brand_name}}"
                                            width="102" height="48" />
                                    <div class="brand-info d-flex flex-column">
                                        <span>Category: {{ $cat->category_name }} <i class="fa fa-chevron-right" style="font-size: 11px;color:#555"></i> {{ $subcat->subcategory_name }}</span>
                                        <span>SKC: {{$product->code}}</span>
                                    </div>
                                </div>
                                <div class="brand-hr"></div>
                                <div class="pricebox">
                                    @if($product->discount_price==null)
                                        <span class="regular-price">{{$setting->currency}}{{$product->selling_price}}</span>
                                    @else
                                        <span class="regular-price">{{$setting->currency}}{{$product->selling_price}}</span>
                                        <del class="old-price">{{$setting->currency}}{{$product->discount_price}}</del>
                                    @endif
                                </div>
                                <div class="ratings">
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <div class="pro-review">
                                        <span class="ratings-count">(3 Reviews)</span>
                                    </div>
                                </div>
                                <div class="availability mt-10">
                                    @if ($product->stock_quantity>1)
                                    <h5>Availability:</h5> 
                                    <span class="badge badge-success badge-sm text-white">{{$product->stock_quantity}} {{$product->unit}} in Stock </span>                                        
                                    @else
                                    <h5>Availability:</h5> 
                                    <span class="badge badge-danger text-white">Out of Stock</span>                                                
                                    @endif
                                </div>
                                
                                <p>{!! Str::of( htmlspecialchars_decode( $product->description ))-> words(20, '...') !!}</p>
                                <div class="brand-hr"></div>
                                <div class="brand-color-size d-flex" style="gap: 20px">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @isset($product->color)
                                            <div class="form-group d-flex flex-column">
                                                <label>Color</label>
                                                <select name="" class="form-control">
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
                                                <select name="" class="form-control">
                                                    @foreach ($sizes as $item)
                                                        <option value="{{$item}}">{{$item}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endisset
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <div class="quantity">
                                        <div class="pro-qty"><input type="text" value="1"></div>
                                    </div>
                                    <div class="action_link w-100">
                                        <a class="buy-btn w-100" href="#">add to cart<i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews mt-34">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_two">information</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_three">reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            <p>{!! Str::of( htmlspecialchars_decode( $product->description )) !!}</p>                                                                                       
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_two">
                                        <table class="table table-bordered">
                                            <tbody>
                                                @isset($product->color)
                                                <tr>
                                                    <td>color</td>
                                                    <td>{{$product->color}}</td>
                                                </tr>
                                                @endisset
                                                @isset($product->size)
                                                <tr>
                                                    <td>size</td>
                                                    <td>{{$product->size}}</td>
                                                </tr>
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="brand-rating-details d-flex">
                                                 <span class="text-danger font-weight-bold" style="font-size:40px;margin-right:10px;margin-top:10px">{{round($sum_rating/$count_rating)}}</span>
                                                <div class="brand-rating d-flex flex-column">
                                                    <div class="review-box">
                                                        <strong>Avarage Ratings</strong>
                                                        @if(intval($sum_rating/$count_rating) >= 5)
                                                        <div class="ratings" data-toggle="tooltip" title="5.00" >
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                                            <span class="four_star"><i class="fa fa-star"></i></span>
                                                            <span class="five_star"><i class="fa fa-star"></i></span>
                                                            <span class="ratings-count">({{$sum_rating}} Rating)</span>
                                                        </div>
                                                        @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
                                                        <div class="ratings" data-toggle="tooltip" title="4.00" >
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                                            <span class="four_star"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span class="ratings-count">({{$sum_rating}} Rating)</span>
                                                        </div>
                                                        @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
                                                        <div class="ratings" data-toggle="tooltip" title="3.00" >
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span class="ratings-count">({{$sum_rating}} Rating)</span>
                                                        </div>
                                                        @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
                                                        <div class="ratings" data-toggle="tooltip" title="2.00" >
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span class="ratings-count">({{$sum_rating}} Rating)</span>
                                                        </div>
                                                        @else
                                                        <div class="ratings" data-toggle="tooltip" title="1.00" >
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span class="ratings-count">({{$sum_rating}} Rating)</span>
                                                        </div>
                                                        @endif                                                       
                                                    </div>
                                                </div>
                                                </div>

                                                {{-- Total Review --}}
                                                <div class="total-review my-5">
                                                    <strong>Total Review of this Product</strong>
                                                    <div class="brand-hr"></div>
                                                    {{-- review 5 star --}}
                                                    <div class="review-box d-flex">
                                                        <div class="ratings" data-toggle="tooltip" title="5.00">
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                                            <span class="four_star"><i class="fa fa-star"></i></span>
                                                            <span class="five_star"><i class="fa fa-star"></i></span>                                                            
                                                        </div>
                                                        <h5>Total <i class="fa fa-hand-o-right"></i> {{$review_5}}</h5>
                                                    </div>
                                                    {{-- review 4 star --}}
                                                    <div class="review-box d-flex">
                                                        <div class="ratings" data-toggle="tooltip" title="4.00">
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                                            <span class="four_star"><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>                                                            
                                                        </div>
                                                        <h5>Total <i class="fa fa-hand-o-right"></i> {{$review_4}}</h5>
                                                    </div>
                                                    {{-- review 3 star --}}
                                                    <div class="review-box d-flex">
                                                        <div class="ratings" data-toggle="tooltip" title="3.00">
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class="three_star"><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>                                                            
                                                        </div>
                                                        <h5>Total <i class="fa fa-hand-o-right"></i> {{$review_3}}</h5>
                                                    </div>
                                                    {{-- review 2 star --}}
                                                    <div class="review-box d-flex">
                                                        <div class="ratings" data-toggle="tooltip" title="2.00">
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class="two_star"><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>                                                            
                                                        </div>
                                                        <h5>Total <i class="fa fa-hand-o-right"></i> {{$review_2}}</h5>
                                                    </div>
                                                    {{-- review 1 star --}}
                                                    <div class="review-box d-flex">
                                                        <div class="ratings" data-toggle="tooltip" title="1.00">
                                                            <span class="one_star"><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>
                                                            <span class=""><i class="fa fa-star"></i></span>                                                            
                                                        </div>
                                                        <h5>Total <i class="fa fa-hand-o-right"></i> {{$review_1}}</h5>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <form action="{{route('review.store')}}" id="review_form" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Write your Review <span class="text-danger">*</span> </label>
                                                        <textarea name="review" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                      </div>
                                                      <input type="hidden" name="product_id" value="{{$product->id}}">
                                                      <div class="form-group d-flex flex-column">
                                                        <label>Select your Rating <span class="text-danger">*</span> </label>
                                                        <select name="rating" class="form-control">
                                                            <option value="5">5 Star</option>
                                                            <option value="4">4 Star</option>
                                                            <option value="3">3 Star</option>
                                                            <option value="2">2 Star</option>
                                                            <option value="1">1 Star</option>
                                                        </select>
                                                      </div>
                                                      <div class="form-group">
                                                        @if (Auth::check())
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-star"></i> Submit</button>                                                            
                                                        @else
                                                        <span class="btn btn-success"><i class="fa fa-star"></i> Please login first</span>
                                                        @endif
                                                      </div>
                                                </form>
                                            </div>
                                        </div>

                                        <strong class="text-center d-block">All Reviews of Product: {{$product->name}}</strong> <hr>
                                        <div class="review-section">
                                            <div class="row">
                                                @foreach ($reviews as $item)
                                                <div class="col-md-6">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <div class="review-details d-flex align-items-center">
                                                                <img src="{{asset('frontend/img/review.png')}}" width="70" height="70" alt="">
                                                                <div class="review-info d-flex flex-column">
                                                                    <h4>{{$item->user->name}}</h4>
                                                                    <p>{{date('d F, Y'), strtotime($item->review_date)}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <p>{{$item->review}}</p> 
                                                            
                                                            @if ($item->rating==5)
                                                            <div class="ratings">
                                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                                <span class="three_star"><i class="fa fa-star"></i></span>
                                                                <span class="four_star"><i class="fa fa-star"></i></span>
                                                                <span class="five_star"><i class="fa fa-star"></i></span>
                                                            </div>
                                                            @elseif($item->rating==4)
                                                            <div class="ratings">
                                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                                <span class="three_star"><i class="fa fa-star"></i></span>
                                                                <span class="four_star"><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                            @elseif($item->rating==3)
                                                            <div class="ratings">
                                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                                <span class="three_star"><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                            @elseif($item->rating==2)
                                                            <div class="ratings">
                                                                <span class="one_star"><i class="fa fa-star"></i></span>
                                                                <span class="two_star"><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                            @elseif($item->rating==1)
                                                            <div class="ratings">
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
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- product details reviews end --> 

                <!-- related products area start -->
                <div class="related-products-area mt-34">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <h3>related products</h3>
                    </div> <!-- section title end -->
                    <!-- featured category start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        <!-- product single item start -->
                        @foreach ($related_product as $item)   
                        <div class="product-item fix">
                            <div class="product-thumb">
                                <a href="#">                                       
                                    <img src="{{url('storage/products/' .$item-> thumbnail)}}" class="img-pri" alt="">
                                    {{-- <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" class="img-sec" alt=""> --}}
                                </a>
                                <div class="product-label">
                                    <span>New</span>
                                </div>
                                <div class="product-action-link">
                                    <a href="#" data-toggle="modal" data-target="#quick_view"> <span data-toggle="tooltip" data-placement="left" title="Quick view"><i class="fa fa-search"></i></span> </a>
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Compare"><i class="fa fa-refresh"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{route('product.details', $item->slug)}}"> {!! Str::of( htmlspecialchars_decode( $item->name ))-> words(3, '...') !!} </a></h4>
                                <div class="pricebox">
                                    <span class="regular-price">
                                    @if($product->discount_price==null)
                                        <span class="regular-price">{{$setting->currency}}{{$product->selling_price}}</span>
                                    @else
                                        <span class="regular-price">{{$setting->currency}}{{$product->selling_price}}</span>
                                        <del class="old-price">{{$setting->currency}}{{$product->discount_price}}</del>
                                    @endif
                                    </span>
                                    <div class="ratings">
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <div class="pro-review">
                                            <span class="ratings-count">10 (Reviews)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- featured category end -->
                </div>
                <!-- related products area end -->
            </div>

            <!-- sidebar start -->
            <div class="col-lg-3">
                <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                    <!-- featured category start -->
                    <div class="sidebar-widget mb-22">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>featured</h3>
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="category-carousel-active row" data-row="2">
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img4.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img5.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img6.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img10.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">simple Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del>$180.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend') }}/img/product/product-img12.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">external Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $140.00
                                            </div>
                                            <div class="old-price">
                                                <del>$160.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span class="ratings-count">1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                        </div>
                    </div>
                    <!-- featured category end -->

                    <!-- manufacturer start -->
                    <div class="sidebar-widget mb-22">
                        <div class="sidebar-title mb-10">
                            <h3>Other Information</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <ul>
                                <li><i class="fa fa-truck text-danger"></i> Pickup Point of this Product</li>
                                <li>
                                    <i class="fa fa-long-arrow-right"></i> {{$pick_point->pickup_point_name}} <br>
                                    <i class="fa fa-long-arrow-right"></i> {{$pick_point->pickup_point_address}}
                                </li>
                                <li><i class="fa fa-truck text-danger"></i> Home Delivery</li>
                                <li>
                                    <i class="fa fa-long-arrow-right"></i> (4-8) days after the order place <br>
                                    <i class="fa fa-long-arrow-right"></i> Cash on delivery available
                                </li>
                                <li><i class="fa fa-truck text-danger"></i> Product Return & Warrenty</li>
                                <li>
                                    <i class="fa fa-long-arrow-right"></i> 7 days return guarranty <br>
                                    <i class="fa fa-long-arrow-right"></i> Warrenty not available
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- manufacturer end -->

                    <!-- product Video start -->
                    <div class="sidebar-widget mb-22">
                        <div class="sidebar-title mb-20">
                            <h3>Product Video</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            @isset($product->video)
                            <figure class="banner-media">
                                <iframe style="border-radius: 10px!important" width="265" height="200" src="https://www.youtube.com/embed/{{$product->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                                               
                            </figure>
                            @endisset  
                        </div>
                    </div>
                    <!-- product Video end -->

                    <!-- sidebar banner start -->
                    <div class="sidebar-widget mb-22">
                        <div class="img-container fix img-full mt-30">
                            <a href="#"><img src="{{ asset('frontend') }}/img/banner/banner_shop.jpg" alt=""></a>
                        </div>
                    </div>
                    <!-- sidebar banner end -->
                </div>
            </div>
            <!-- sidebar end -->
        </div>
    </div>
</div>
<!-- product details wrapper end -->

<!-- brand area start -->
<div class="brand-area pt-28 pb-30 pt-md-14 pt-sm-14">
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
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br1.png" alt=""></a>
                    </div>
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br2.png" alt=""></a>
                    </div>
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br3.png" alt=""></a>
                    </div>
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br4.png" alt=""></a>
                    </div>
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br5.png" alt=""></a>
                    </div>
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br6.png" alt=""></a>
                    </div>
                    <div class="brand-item text-center">
                        <a href="#"><img src="{{ asset('frontend') }}/img/brand/br4.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand area end -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

    //store coupon ajax call
  $('#review_form').submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
          if (data=='All fields are required!') {
              toastr.warning(data);
        }
        else if (data=='Already review this product!') {
            toastr.error(data);      
        }else{
            toastr.success(data);
        }
        $('#review_form')[0].reset();
      }
    });
  });  

</script>
    
@endsection