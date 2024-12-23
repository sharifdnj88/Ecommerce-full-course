@extends('layouts.app')
@section('navbar')
@include('layouts.front_partial.collapse_header')    
@endsection
@section('content')

<!-- checkout main wrapper start -->
<div class="checkout-page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Checkout Login Coupon Accordion Start -->
                <div class="checkoutaccordion my-3" id="checkOutAccordion">
                    @if(Session::has('coupon'))
                    <h3> <span style="color: #28a745!important"><i class="fa fa-check"></i></span> Coupon Applied Successfully Done</h3>
                    @else
                    <div class="card">
                        <h3>Have A Coupon? <span data-toggle="collapse" data-target="#couponaccordion">Click Here To Enter Your Code</span></h3>
                        <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                            <div class="card-body">
                                <div class="cart-update-option">
                                    <div class="apply-coupon-wrapper">
                                        <form action="{{route('coupon.apply')}}" method="POST" class=" d-block d-md-flex">
                                        @csrf
                                            <input name="coupon" type="text" placeholder="Enter Your Coupon Code" required />
                                            <button type="submit" class="check-btn sqr-btn">Apply Coupon</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- Checkout Login Coupon Accordion End -->
            </div>
        </div>

        <div class="row">
            <!-- Checkout Billing Details -->
            <div class="col-lg-6">
                <div class="checkout-billing-details-wrap">
                    <h2>Billing Details</h2>
                    <div class="billing-form-wrap">
                        <form action="{{route('order.place')}}" method="POST" id="order_place">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Customer Name</label>
                                        <input name="c_name" value="{{Auth::User()->name}}" type="text" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Customer Phone</label>
                                        <input name="c_phone" value="{{Auth::User()->phone}}" type="text" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Email Address</label>
                                        <input name="c_email" value="{{Auth::User()->email}}" type="email" placeholder="Email Address" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Shipping address</label>
                                        <input name="c_address" type="text" placeholder="Street address" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Town / City</label>
                                        <input name="c_city" type="text"  placeholder="Town / City" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Postcode / ZIP</label>
                                        <input name="c_zipcode" type="text" placeholder="Postcode / ZIP" required />
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label>Country</label>
                                        <input name="c_country" type="text" value="Bangladesh"  placeholder="Country" />
                                    </div>        
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label>Extra Phone</label>
                                        <input name="c_extra_phone" type="text"  placeholder="extra phone" />
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <label for="ordernote">Order Note</label>
                                <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>

            <!-- Order Summary Details -->
            <div class="col-lg-6">
                <div class="order-summary-details mt-md-26 mt-sm-26">
                    <h2>Your Order Summary</h2>
                    <div class="order-summary-content mb-sm-4">
                        <!-- Order Summary Table -->
                        <div class="order-summary-table table-responsive text-center">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content as $item)
                                        <tr>
                                            <td><a href="#">{{$item->name}} <strong> × {{$item->qty}}</strong></a></td>
                                            <td>{{$setting->currency}}{{$item->price * $item->qty }}</td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td><strong>{{$setting->currency}}{{Cart::subtotal()}}</strong></td>
                                    </tr>
                                    @if(Session::has('coupon') && Cart::count() )
                                    <tr>
                                        <td>Coupon Discount</td>
                                        <td><strong>{{$setting->currency}}{{Session::get('coupon')['discount']}} <a href="{{route('remove.coupon')}}" class="text-danger"> <i class="fa fa-times"></i> </a> </strong></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="d-flex justify-content-center">
                                            @if(Session::has('coupon'))
                                            <ul class="shipping-type">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input name="shipping_charge" value="in_dhaka" type="radio" id="in_dhaka" class="custom-control-input" checked disabled />
                                                        <label class="custom-control-label" for="in_dhaka">Charge: {{$setting->currency}}100</label>
                                                    </div>
                                                </li>
                                            </ul>
                                            @else
                                            <ul class="shipping-type">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input name="shipping_charge" value="in_dhaka" type="radio" id="in_dhaka" class="custom-control-input" checked />
                                                        <label class="custom-control-label" for="in_dhaka">Inside Dhaka: {{$setting->currency}}100</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input name="shipping_charge" value="out_dhaka" type="radio" id="out_dhaka" class="custom-control-input" />
                                                        <label class="custom-control-label" for="out_dhaka">Outside Dhaka: {{$setting->currency}}150</label>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        @if(Session::has('coupon') && Cart::count() )
                                        <td>
                                            <strong>{{$setting->currency}}<span class="shipping_charge_total">{{ (Cart::total()+Cart::count() *100) - (Session::get('coupon')['discount']) }}  </span> </strong>                                            
                                        </td>
                                        @else
                                        <td>
                                            <strong>{{$setting->currency}}<span class="shipping_charge_total">{{ Cart::total()+Cart::count() *100 }} </span> </strong>
                                        </td>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Order Payment Method -->
                        <div class="order-payment-method">
                            <div class="single-payment-method show">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cashon" name="payment_type" value="Hand Cash" class="custom-control-input" checked  />
                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="directbank" name="payment_type" value="Aamarpay" class="custom-control-input" />
                                        <label class="custom-control-label" for="directbank">Bkash/Rocket/Nagad</label>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-footer-area">
                                <button type="submit" class="check-btn sqr-btn">Place Order</button>
                                <button class="check-btn sqr-btn d-none" type="button" disabled>
                                    <span class="fa-spin text-white fa fa-spinner"></span>
                                    Processing...
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- checkout main wrapper end -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" charset="utf-8">
    function cart() {
         $.ajax({
            type:'get',
            url:'{{ route('all.cart') }}', 
            dataType: 'json',
            success:function(data){
               $('.cart_qty').empty();
               $('.cart_total').empty();
               $('.cart_qty').append(data.cart_qty);
               $('.cart_total').append(data.cart_total);
            }
        });
    }
    $(document).ready(function(event) {
        cart();        
    });
    
 </script>

 <script>
    $('#in_dhaka').click(function (){
        let charge = 100;
        $.get('shipping-charge/'+charge, function(data){
            $('.shipping_charge_total').html(data);            
        });

    });
    $('#out_dhaka').click(function (){
        let charge = 150;
        $.get('shipping-charge/'+charge, function(data){
            $('.shipping_charge_total').html(data);            
        });
    });



 </script>


@endsection