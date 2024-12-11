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
                    <div class="cart-table table-responsive cart-table-area">
                        <table class="table table-bordered cart-table-header">
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-quantity">Quantity</th>
                                <th class="pro-quantity">Color</th>
                                <th class="pro-quantity">Size</th>
                                <th class="pro-subtotal">SubTotal</th>
                                <th class="pro-remove">Action</th>
                            </tr>
                            </thead>
                            <tbody class="cart-table-body">
                            @foreach ($content as $item)  
                            @php
                                $product=DB::table('products')->where('id', $item->id)->first();
                                $colors=explode(',',$product->color);
                                $sizes=explode(',',$product->size);
                            @endphp                          
                            <tr class="cartpage">
                                <td class="pro-thumbnail">
                                    <a href="#">
                                        <img class="img-fluid" src="{{url('storage/products/' .$item -> options-> thumbnail)}}" alt="{{$item->name}}"/>
                                    </a>
                                </td>
                                <td class="pro-title"><a href="#"> {{substr($item->name,0,30) }}</a></td>
                                <td class="pro-price"><span>{{$setting->currency}}{{$item->price}}x{{$item->qty}}</span></td>
                                {{-- This input hidden for cart quantity Update --}}
                                <input type="hidden" class="cart_quantity_id" value="{{$item->rowId}}">
                                <td class="pro-quantity">
                                    <div class="pro-qty changeQuantity">
                                        <input name="qty" type="text" class="qty-input" value="{{$item->qty}}">
                                    </div>                                    
                                </td>
                                <td>
                                    {{-- This input hidden for cart Color Update --}}
                                    <input type="hidden" class="cart_color_id" value="{{$item->rowId}}">
                                    @if($item->options->color)                                    
                                    <select name="color" class="form-control color">
                                        @foreach ($colors as $clrs)
                                            <option value="{{$clrs}}" @if($clrs==$item->options->color) selected @endif>{{$clrs}}</option>         
                                        @endforeach
                                    </select>
                                    @endif
                                </td>
                                <td>
                                    @if($item->options->size)   
                                    <select name="size" class="form-control size" data-id="{{ $item->rowId }}">
                                        @foreach ($sizes as $size)
                                            <option value="{{$size}}" @if($size==$item->options->size) selected @endif>{{$size}}</option> 
                                        @endforeach
                                    </select>
                                    @endif
                                </td>
                                {{-- This input hidden for cart Delete --}}
                                <input type="hidden" class="product_id" value="{{$item->rowId}}">
                                <td class="pro-subtotal">
                                    <span>{{$setting->currency}} {{$item->price*$item->qty }} </span>                                    
                                </td>  


                                <td class="pro-remove" style="font-size: 16px;gap:10px">
                                    <a href="#" type="button" class="update_cart_data mx-2 text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update"><i class="fa fa-refresh"></i></a>
                                    <a href="#" type="button" class="delete_cart_data text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="mx-2 text-danger"><i class="fa fa-trash-o"></i></a>                                    
                                </td>
                                
                            </tr>                            
                            @endforeach
                            <tr style="background-color: #e1e1e1">
                                <td class="text-right" colspan="8"> <strong>Order Total={{$setting->currency}}</strong> <span class="cart_total"></span> </td>                                
                            </tr>
                            </tbody>
                        </table>
                    </div>                   
                   
    
                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <div class="apply-coupon-wrapper">
                            <form action="#" method="post" class=" d-block d-md-flex">
                                <input type="text" placeholder="Enter Your Coupon Code" required />
                                <button class="btn btn-outline-danger">Apply Coupon</button>
                            </form>
                        </div>
                        <div class="cart-update mt-sm-16">
                            <a href="{{route('all.cart.item.destroy')}}" class="btn btn-outline-danger">Empty Cart</a>
                            <a href="#" class="sqr-btn ">Proced to Checkout</a>
                        </div>
                    </div>                    
                </div>
            </div>
    
            {{-- <div class="row">
                <div class="col-lg-5 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3>Cart Totals</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>$230</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$70</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">$300</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <a href="checkout.html" class="sqr-btn d-block">Proceed To Checkout</a>
                    </div>
                </div>
            </div> --}}
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
                        <a href="#"><img src="{{url('storage/brands/' .$item -> brand_logo)}}" alt="{{$item->brand_name}}" width="100%"></a>
                    </div>                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand area end -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



{{-- Size Update --}}
<script>
     //size update
     $(document).ready(function () {
     $('.size').change(function (e) {
        e.preventDefault();
		    let size=$(this).val();
		    let rowId=$(this).data('id');

		    $.ajax({
		      url:'{{ url('update-cart-size/') }}/'+rowId+'/'+size,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
                cart();
		        location.reload();
		      }
		    });
		  });
        });
</script>

{{-- _____Update Cart Color Data --}}
<script>
    $(document).ready(function () {
    
    $('.color').change(function (e) {
        e.preventDefault();
    
        var color = $(this).closest(".cartpage").find('.color').val();
        var color_id = $(this).closest(".cartpage").find('.cart_color_id').val(); 
        
        var data = {
            '_token': $('input[name=_token]').val(),
            'color':color,
            'color_id':color_id,
        };
    
        $.ajax({
            url: '/update-cart-color',
            type: 'POST',
            data: data,
            success: function (response) {
                window.location.reload();
                toastr.success(response.status);
                cart();
            }
        });
    });
    
    });
    </script>


{{-- _____Update Cart Quantity Data --}}
<script>
$(document).ready(function () {

$('.changeQuantity').click(function (e) {
    e.preventDefault();

    $('.loading-effect').show();
    $('.cart-table-body').hide();

    var qty = $(this).closest(".cartpage").find('.qty-input').val();
    var product_id = $(this).closest(".cartpage").find('.cart_quantity_id').val(); 

    var data = {
        '_token': $('input[name=_token]').val(),
        'qty':qty,
        'product_id':product_id,
    };

   

    $.ajax({
        url: '/update-cart-qty',
        type: 'POST',
        data: data,
        success: function (response) {
            window.location.reload();
            // $('#subtotalid').load(location.href + ' #subtotalid');
            toastr.success(response.status);            
            cart();
            
            $load=setTimeout(function() {
                $('.loading-effect').hide();                
                $('.cart-table-body').show();
                clearTimeout($load);            
            }, 500);
        }
    });


    
});

});
</script>



{{--  _______Delete Cart Data without reload page --}}
<script>
    // Delete Cart Data without reload page
$(document).ready(function () {
$('.delete_cart_data').click(function (e) {
    e.preventDefault();

    $('.loading-effect').show();
    $('.cart-table-body').hide();

    var thisDeleteArea= $(this);
    var product_id = $(this).closest(".cartpage").find('.product_id').val();

    var data = {
        '_token': $('input[name=_token]').val(),
        "product_id": product_id,
    };

    $.ajax({
        url: '/delete-from-cart',
        type: 'DELETE',
        data: data,
        success: function (response) {        
            thisDeleteArea.closest(".cartpage").remove();
            toastr.success(response.status);
            cart();
            $load=setTimeout(function() {
                $('.loading-effect').hide();                
                $('.cart-table-body').show();
                clearTimeout($load);            
            }, 500);
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