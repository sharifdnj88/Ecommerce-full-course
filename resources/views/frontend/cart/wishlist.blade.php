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
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">  
                    {{-- loading effect start --}}
                    <div class="loading-effect">
                        <h2></h2>
                    </div>
                    {{-- loading effect End --}}
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-quantity">Stock Status</th>
                                <th class="pro-price">Date</th>
                                <th class="pro-price">Action</th>
                            </tr>
                            </thead>
                            <tbody class="cart-table-body">
                            @foreach ($wishlist as $item)  
                                                     
                            <tr class="cartpage">
                                <td class="pro-thumbnail">
                                    <a href="{{route('product.details', $item->slug)}}">
                                        <img class="img-fluid" src="{{url('storage/products/' .$item -> thumbnail)}}" alt="{{$item->name}}"/>
                                    </a>
                                </td>
                                <td class="pro-title"><a href="{{route('product.details', $item->slug)}}"> {{substr($item->name,0,30) }}</a></td>
                                <td class="pro-price">
                                    @if($item->discount_price==null)
                                    <span>Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                    @else
                                    <span>Price: {{$setting->currency}}{{$item->discount_price}}</span>
                                    <span class="badge badge-danger badge-sm" style="text-decoration: line-through;">Price: {{$setting->currency}}{{$item->selling_price}}</span>
                                    @endif
                                </td>
                                <td class="pro-quantity">
                                    @if ($item->stock_quantity>1)
                                    <span class="text-success">In Stock </span>                                        
                                    @else
                                    <span class="text-danger">Out of Stock</span>                                                
                                    @endif
                                </td>
                                <td class="pro-title"><span> {{$item->date }}</span></td>
                               {{-- This input hidden for cart Delete --}}
                               <input type="hidden" class="wishlist_id" value="{{$item->id}}">
                                <td class="pro-thumbnail" style="font-size: 25px"> 
                                    <a href="{{route('product.details', $item->slug)}}" class="text-success mx-3" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add To Cart"><i style="margin-left: 5px" class="fa fa-shopping-cart"></i></a>                                                                        
                                    <a href="#" type="button" class="delete_wishlish_data text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                                
                            </tr>                            
                            @endforeach
                            </tbody>
                        </table>
                    </div>                   
                   
    
                    <!-- Cart Update Option -->
                    <div class="my-3">                        
                        <div class="my-3 d-flex justify-content-end" style="gap: 10px">
                            <a href="{{route('all.wishlist.item.destroy')}}" class="btn btn-outline-danger">Empty wishlist</a>
                            <a href="{{url('/')}}" class="btn btn-success ">Back Home</a>
                        </div>
                    </div>                    
                </div>
            </div>    
           
        </div>
    </div>
    <!-- cart main wrapper end -->

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


{{--  _______Delete Wishlist Data without reload page --}}
<script>
$(document).ready(function () {
$('.delete_wishlish_data').click(function (e) {
    e.preventDefault();

    $('.loading-effect').show();
    $('.cart-table-body').hide();

    var thisDeleteArea= $(this);
    var wishlist_id = $(this).closest(".cartpage").find('.wishlist_id').val();

    var data = {
        '_token': $('input[name=_token]').val(),
        "wishlist_id": wishlist_id,
    };

    $.ajax({
        url: '/delete-from-wishlist',
        type: 'DELETE',
        data: data,
        success: function (response) {        
            thisDeleteArea.closest(".cartpage").remove();
            toastr.success(response.status);
            wishlist();
            $load=setTimeout(function() {
                $('.loading-effect').hide();                
                $('.cart-table-body').show();
                clearTimeout($load);            
            }, 300);
        }
    });
});

});
</script>



<script type="text/javascript" charset="utf-8">
    function wishlist() {
         $.ajax({
            type:'get',
            url:'{{ route('all.wishlist') }}', 
            dataType: 'json',
            success:function(data){                
               $('.wishlist_qty').empty();
               $('.wishlist_qty').append(data.wishlist_qty);
            }
        });
    }
    $(document).ready(function(event) {
        wishlist();        
    });
    
 </script>


@endsection