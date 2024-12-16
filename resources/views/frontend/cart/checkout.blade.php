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
                    <div class="card">
                        <h3>Have A Coupon? <span data-toggle="collapse" data-target="#couponaccordion">Click Here To Enter Your Code</span></h3>
                        <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                            <div class="card-body">
                                <div class="cart-update-option">
                                    <div class="apply-coupon-wrapper">
                                        <form action="#" method="post" class=" d-block d-md-flex">
                                            <input type="text" placeholder="Enter Your Coupon Code" required />
                                            <button class="check-btn sqr-btn">Apply Coupon</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Customer Name</label>
                                        <input name="name" value="{{Auth::User()->name}}" type="text" id="f_name" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label class="required">Customer Phone</label>
                                        <input name="phone" value="{{Auth::User()->phone}}" type="text" required />
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label class="required">Email Address</label>
                                <input name="email" value="{{Auth::User()->email}}" type="email" placeholder="Email Address" required />
                            </div>

                            <div class="single-input-item">
                                <label class="required pt-20">Shipping address</label>
                                <input name="address" type="text" placeholder="Street address" required />
                            </div>

                            <div class="single-input-item">
                                <label class="required">Town / City</label>
                                <input name="city" type="text"  placeholder="Town / City" required />
                            </div>

                            <div class="single-input-item">
                                <label>State / Divition</label>
                                <input name="division" type="text"  placeholder="State / Divition" />
                            </div>

                            <div class="single-input-item">
                                <label>Country</label>
                                <input name="country" type="text" value="Bangladesh"  placeholder="Country" />
                            </div>

                            <div class="single-input-item">
                                <label class="required">Postcode / ZIP</label>
                                <input name="zipcode" type="text" placeholder="Postcode / ZIP" required />
                            </div> 

                            <div class="single-input-item">
                                <label for="ordernote">Order Note</label>
                                <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </form>
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
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="d-flex justify-content-center">
                                            <ul class="shipping-type">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input name="shipping_charge" value="100" type="radio" id="in_dhaka" class="custom-control-input" checked />
                                                        <label class="custom-control-label" for="in_dhaka">Inside Dhaka: {{$setting->currency}}100</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input name="shipping_charge" value="150" type="radio" id="out_dhaka" class="custom-control-input" />
                                                        <label class="custom-control-label" for="out_dhaka">Outside Dhaka: {{$setting->currency}}150</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>{{$setting->currency}}<span class="shipping_charge_total">{{ Cart::total()+Cart::count() *100 }} </span> </strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Order Payment Method -->
                        <div class="order-payment-method">
                            <div class="single-payment-method show">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked  />
                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="cash">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>
                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="directbank" name="paymentmethod" value="bank" class="custom-control-input" />
                                        <label class="custom-control-label" for="directbank">SSL Commerz</label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="bank">
                                    <p>Bkash/Nagad/Rocket</p>
                                </div>
                            </div>
                            <div class="summary-footer-area">
                                <button type="submit" class="check-btn sqr-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        let charge = $(this).val();
        $.get('shipping-charge/'+charge, function(data){
            $('.shipping_charge_total').html(data);            
        });

    });
    $('#out_dhaka').click(function (){
        let charge = $(this).val();
        $.get('shipping-charge/'+charge, function(data){
            $('.shipping_charge_total').html(data);            
        });
    });
 </script>


@endsection