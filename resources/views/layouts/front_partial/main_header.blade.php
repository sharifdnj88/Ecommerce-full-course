@php
    $category=DB::table('categories')->where('home_page',1)->orderBy('id', 'DESC')->take(9)->get();
@endphp
<header>
    <!-- header top start -->
    <div class="header-top-area bg-gray text-center text-md-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="header-call-action">
                        <a href="#">
                            <i class="fa fa-envelope"></i>
                            khalifashopbd.com
                        </a>
                        <a href="tel:+8801601153971">
                            <i class="fa fa-phone"></i>
                            +8801601153971
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="header-top-right float-md-right float-none" id="loginReg">
                        <nav>
                            <ul>
                                @guest
                                    <li>
                                        <div class="dropdown header-top-dropdown">
                                            <a href="#" data-toggle="modal" data-target="#login_register">
                                                <i class="fa fa-user"></i> Login / Register
                                            </a>
                                        </div>
                                    </li>
                                @else
                                <li>
                                    <div class="dropdown header-top-dropdown">
                                        <a href="#" class="text-success" data-toggle="modal" data-target="#myaccount">
                                            <i class="fa fa-user"></i> {{Auth::User()->name}} Profile
                                        </a>
                                    </div>
                                </li>
                                @endguest

                                <li>
                                   @if (Auth::check())
                                    <div class="header-mini-wishlist">
                                        <div class="mini-wishlist-btn">
                                            <a href="{{route('wishlist')}}">
                                            <i class="fa fa-heart"></i>
                                            <span class="wishlist-notification wishlist_qty"></span>
                                            </a>                                          
                                        </div>
                                    </div> 
                                    @else
                                        <div class="header-mini-wishlist">
                                            <div class="mini-wishlist-btn">
                                                <i class="fa fa-heart-o"></i>
                                                <span class="wishlist-notification">0</span>                                          
                                            </div>
                                        </div> 
                                    @endif
                                </li>
                                <li>
                                    <a href="#">my cart</a>
                                </li>
                                <li>
                                    <a href="#">checkout</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top end -->

    <!-- header middle start -->
    <div class="header-middle-area pt-20 pb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-logo">
                        <a href="{{url('/')}}">
                            <img src="{{ asset('frontend') }}/img/logo/logo.png" alt="brand logo">
                        </a>
                    </div>
                </div> <!-- end logo area -->
                <div class="col-lg-9">
                    <div class="header-middle-right">
                        <div class="header-middle-block">
                            <div class="header-middle-searchbox">
                                <input type="text" placeholder="Search...">
                                <button class="search-btn"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="header-mini-cart">
                                <div class="mini-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="cart-notification cart_qty"></span>
                                </div>
                                <div class="cart-total-price" style="font-size: 12px">
                                    <a class="text-white" href="{{route('cart')}}">
                                    <span>total</span>
                                    <div class="cart-total-area d-flex">
                                        @isset($setting->currency)
                                        <span>{{$setting->currency}}</span>
                                        <span class="cart_total"></span>
                                        @endisset                                        
                                    </div>
                                    </a>
                                </div>
                                <ul class="cart-list">
                                    <li>
                                        <div class="cart-img">
                                            <a href="product-details.html"><img src="{{ asset('frontend') }}/img/cart/cart-1.jpg"
                                                    alt=""></a>
                                        </div>
                                        <div class="cart-info">
                                            <h4><a href="product-details.html">simple product 09</a></h4>
                                            <span>$60.00</span>
                                        </div>
                                        <div class="del-icon">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cart-img">
                                            <a href="product-details.html"><img src="{{ asset('frontend') }}/img/cart/cart-2.jpg"
                                                    alt=""></a>
                                        </div>
                                        <div class="cart-info">
                                            <h4><a href="product-details.html">virtual product 10</a></h4>
                                            <span>$50.00</span>
                                        </div>
                                        <div class="del-icon">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                    <li class="mini-cart-price">
                                        <span class="subtotal">subtotal : </span>
                                        <span class="subtotal-price">$88.66</span>
                                    </li>
                                    <li class="checkout-btn">
                                        <a href="#">checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header middle end -->

    <!-- main menu area start -->
    <div class="main-header-wrapper bdr-bottom1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-header-inner">
                        <div class="category-toggle-wrap">
                            <div class="category-toggle">
                                Browse Categories
                                <div class="cat-icon">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <nav class="category-menu hm-1">
                                <ul>
                                    @foreach ($category as $item)
                                    @php
                                        $subcategory=DB::table('subcategories')->where('category_id', $item->id)->get();
                                    @endphp
                                    <li class="menu-item-has-children">
                                        <a href="{{route('categorywise.product',$item->id)}}">
                                            <img src="{{url('storage/categories/' .$item -> icon)}}" height="18" width="18" alt="{{$item->category_name}}">  {{$item->category_name}}
                                        </a>                                        
                                        <!-- Mega Category Menu Start -->
                                        <ul class="category-mega-menu">
                                            @foreach ($subcategory as $item)  
                                            @php
                                                $childcategory=DB::table('childcategories')->where('subcategory_id', $item->id)->get();
                                            @endphp                                                                                        
                                            <li class="menu-item-has-children sub-category-item">
                                                <a href="{{route('subcategorywise.product',$item->id)}}"><i class="fa fa-list-alt"></i> {{$item->subcategory_name}}</a>
                                                <ul>
                                                    @foreach ($childcategory as $item) 
                                                    <li><a href="{{route('childcategorywise.product',$item->id)}}"><i class="fa fa-arrow-right"></i> {{$item->childcategory_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul><!-- Mega Category Menu End -->
                                    </li>  
                                    @endforeach                                  
                                </ul>
                            </nav>
                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="active">
                                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home </a>                                        
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-shopping-basket"></i> shop </a>                                       
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-gift"></i> Campaign </a>                                       
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-book"></i> Blog </a>                                        
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-phone-square"></i> Helpline </a>                                        
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-address-book"></i> Contact us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- main menu area end -->


    <!-- Sign / Register modal start -->
    <div class="modal" id="login_register">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row justify-content-center text-center">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                                        </li>
                                      </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="login-reg-form-wrap  pr-lg-50">
                                                <h2>Login</h2>
                                                <form action="{{route('login')}}" method="post">
                                                    @csrf
                                                    <div class="single-input-item">
                                                        <input name="email" type="email" placeholder="Email or Username" required="">
                                                    </div>
                                                    <div class="single-input-item">
                                                        <input name="password" type="password" placeholder="Enter your Password" required="">
                                                    </div>
                                                    <div class="single-input-item">
                                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                            <div class="remember-meta">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input value="{{old('password')}}" type="checkbox" class="custom-control-input" id="rememberMe">
                                                                    <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="forget-pwd">Forget Password?</a>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button type="submit" class="sqr-btn">Login</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="login-reg-form-wrap mt-md-34 mt-sm-34">
                                                <h2>Register Form</h2>
                                                <form action="{{route('register')}}" method="post">
                                                    @csrf
                                                    <div class="single-input-item">
                                                        <input name="name" type="text" placeholder="Full Name" required="">
                                                    </div>
                                                    <div class="single-input-item">
                                                        <input name="email" type="email" placeholder="Enter your Email" required="">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <input name="password" type="password" placeholder="Enter your Password" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <input name="password_confirmation" type="password" placeholder="Repeat your Password" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <div class="login-reg-form-meta">
                                                            <div class="remember-meta">
                                                                <div class="custom-control custom-checkbox text-left">
                                                                    <input type="checkbox" class="custom-control-input" id="subnewsletter">
                                                                    <label class="custom-control-label" for="subnewsletter">Subscribe Our Newsletter</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button type="submit" class="sqr-btn">Register</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                      </div>
                        </div>
                    </div>
                    <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- My Account modal end -->

    <!-- Sign / Register modal start -->
    <div class="modal" id="myaccount">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active show" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>
                                <a href="#orders" data-toggle="tab" class=""><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="#download" data-toggle="tab" class=""><i class="fa fa-cloud-download"></i> Download</a>
                                <a href="#payment-method" data-toggle="tab" class=""><i class="fa fa-credit-card"></i> Payment
                                    Method</a>
                                <a href="#address-edit" data-toggle="tab" class=""><i class="fa fa-map-marker"></i> address</a>
                                <a href="#account-info" data-toggle="tab" class=""><i class="fa fa-user"></i> Account Details</a>
                                <a href="#open-ticket" data-toggle="tab" class=""><i class="fa fa-pencil-square-o"></i> Open Ticket</a>
                                <a href="#write-review" data-toggle="tab" class=""><i class="fa fa-pencil-square-o"></i> Write Review</a>
                                <a href="{{route('customer.logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade active show" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>
                                        <div class="welcome">
                                            <p>Hello, <strong> @isset(Auth::User()->name){{Auth::User()->name}}
                                            @endisset </strong> (If Not <strong>Tuntuni !</strong><a href="login-register.html" class="logout"> Logout</a>)</p>                                                
                                        </div>
                                        <p class="mb-0">From your account dashboard. you can easily check &amp; view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Aug 22, 2018</td>
                                                        <td>Pending</td>
                                                        <td>$3000</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>July 22, 2018</td>
                                                        <td>Approved</td>
                                                        <td>$200</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>June 12, 2017</td>
                                                        <td>On Hold</td>
                                                        <td>$990</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="download" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Downloads</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Expire</th>
                                                    <th>Download</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Haven - Free Real Estate PSD Template</td>
                                                        <td>Aug 22, 2018</td>
                                                        <td>Yes</td>
                                                        <td><a href="#" class="check-btn sqr-btn "><i class="fa fa-cloud-download"></i> Download File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>HasTech - Profolio Business Template</td>
                                                        <td>Sep 12, 2018</td>
                                                        <td>Never</td>
                                                        <td><a href="#" class="check-btn sqr-btn "><i class="fa fa-cloud-download"></i> Download File</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>
                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Billing Address</h3>
                                        <address>
                                            <p><strong>Alex Tuntuni</strong></p>
                                            <p>1355 Market St, Suite 900 <br>
                                                San Francisco, CA 94103</p>
                                            <p>Mobile: (123) 456-7890</p>
                                        </address>
                                        <a href="#" class="check-btn sqr-btn "><i class="fa fa-edit"></i> Edit Address</a>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="font-weight-bold">Your Default Credentials</h3>
                                        <div class="account-details-form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="shipping_name" class="required">Shipping Name</label>
                                                            <input name="shipping_name" type="text" id="shipping_name" placeholder="Shipping Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="shipping_phone" class="required">Shipping Phone</label>
                                                            <input name="shipping_phone" type="text" id="shipping_phone" placeholder="Shipping Phone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="shipping_country" class="required">Shipping Country</label>
                                                            <input name="shipping_country" type="text" id="shipping_country" placeholder="Shipping Country">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="shipping_city" class="required">Shipping City</label>
                                                            <input name="shipping_city" type="text" id="shipping_city" placeholder="Shipping City">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="shipping_zipcode" class="required">Shiiping Zipcode</label>
                                                    <input name="shipping_zipcode" type="text" id="shipping_zipcode" placeholder="Code">
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="shipping_address" class="required">Shiiping Address</label>
                                                    <input name="shipping_address" type="text" id="shipping_address" placeholder="Shipping Address">
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Shipping Email</label>
                                                    {{-- <input name="shipping_email" type="email" id="email" value="{{Auth::User()->email}}" placeholder="Shipping Email"> --}}
                                                </div>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Submit</button>
                                                </div>
                                                </form>

                                                <form action="{{route('customer.password.change')}}" id="customer_pass_form" method="POST">
                                                @csrf
                                                <fieldset class="mt-40">
                                                    <legend class="font-weight-bold">Password change</legend>
                                                    <div class="single-input-item">
                                                        <label for="old_password" class="required">Current Password</label>
                                                        <input name="old_password" type="password" id="old_password" placeholder="Current Password">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="password" class="required">New Password</label>
                                                                <input name="password" type="password" id="password" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="password_confirmation" class="required">Confirm Password</label>
                                                                <input name="password_confirmation" type="password" id="password_confirmation" placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="open-ticket" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <strong class="text-success">Product Problem</strong>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('webreview.store')}}" method="POST" id="open_ticket">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    @isset(Auth::User()->name)
                                                        <input name="name" type="text" value="{{Auth::User()->name}}" class="form-control" readonly>                                                        
                                                    @endisset
                                                </div>
                                                <div class="form-group">
                                                    <label>Write Review <span class="text-danger">*</span> </label>
                                                    <textarea name="review" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group d-flex flex-column">
                                                    <label>Ratings <span class="text-danger">*</span> </label>
                                                    <select name="rating" class="form-control w-100">
                                                        <option value="5">5 Star</option>
                                                        <option value="4">4 Star</option>
                                                        <option value="3">3 Star</option>
                                                        <option value="2">2 Star</option>
                                                        <option value="1">1 Star</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-star"></i> Submit Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="write-review" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <strong class="text-success">Send your valuable Review base on our product quality and services</strong>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('webreview.store')}}" method="POST" id="web_review_form">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    @isset(Auth::User()->name)
                                                        <input name="name" type="text" value="{{Auth::User()->name}}" class="form-control" readonly>                                                        
                                                    @endisset
                                                </div>
                                                <div class="form-group">
                                                    <label>Write Review <span class="text-danger">*</span> </label>
                                                    <textarea name="review" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group d-flex flex-column">
                                                    <label>Ratings <span class="text-danger">*</span> </label>
                                                    <select name="rating" class="form-control w-100">
                                                        <option value="5">5 Star</option>
                                                        <option value="4">4 Star</option>
                                                        <option value="3">3 Star</option>
                                                        <option value="2">2 Star</option>
                                                        <option value="1">1 Star</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-star"></i> Submit Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account modal end -->

</header>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" charset="utf-8">
    //store Website Review ajax call
  $('#web_review_form').submit(function(e){
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
        else if (data=='Review already exist!') { 
            toastr.error(data);    
        }else{
            toastr.success(data);
        }
        $('#web_review_form')[0].reset();    
      }
    });
  });  

    // Customer Password Change
  $('#customer_pass_form').submit(function(e){
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
        }else if(data=='Password Confirmation not match!'){
            toastr.error(data);
        }
        else if (data=='Old Password Not Matched!') { 
            toastr.error(data);    
        }else{
            toastr.success(data);
            $('#myaccount').modal('hide');
        }
        $('#customer_pass_form')[0].reset();    
      }
    });
  });


 </script>

 

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

