<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/demo1.min.css">
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">111/1/A Distillery Road,Gandaria,Dhaka-1204</p>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <a href="#currency">Currency</a>
                    <div class="dropdown-box" style="width: 70px">
                        <a href="#TAKA">TAKA (৳)</a>
                        <a href="#USD">USD ($)</a>
                    </div>
                </div>
                <!-- End of DropDown Menu -->

                <div class="dropdown">
                    <a href="#language">Language</a>
                    <div class="dropdown-box">
                        <a href="#BAN">
                            <img src="{{ asset('frontend') }}/images/flags/ban.jpg" alt="BAN Flag" width="14" height="8"
                                class="dropdown-image" />
                            BAN
                        </a>
                        <a href="#ENG">
                            <img src="{{ asset('frontend') }}/images/flags/eng.png" alt="ENG Flag" width="14" height="8"
                                class="dropdown-image" />
                            ENG
                        </a>                        
                    </div>
                </div>
                <!-- End of Dropdown Menu -->
                <span class="divider d-lg-show"></span>
                <a href="blog.html" class="d-lg-show">Blog</a>
                <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                <a href="my-account.html" class="d-lg-show">My Account</a>
                <a href="{{ asset('frontend') }}/ajax/login.html" class="d-lg-show login sign-in"><i
                        class="w-icon-account"></i>Sign In</a>
                <span class="delimiter d-lg-show">/</span>
                <a href="{{ asset('frontend') }}/ajax/login.html" class="ml-0 d-lg-show login register">Register</a>
            </div>
        </div>
    </div>
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                </a>
                <a href="{{url('/')}}" class="logo ml-lg-0">
                    <img src="{{ asset('frontend') }}/images/logo.png" alt="logo" width="144" height="45" />
                </a>
                <form method="get" action="#"
                    class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                    <div class="select-box">
                        <select id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach ($category as $item)
                                <option value="4">{{$item->category_name}}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="form-control" name="search" id="search" placeholder="Search in..."
                        required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:#" class="w-icon-call"></a>
                    <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="mailto:#" class="text-capitalize">Live Chat</a> or :</h4>
                        <a href="tel:#" class="phone-number font-weight-bolder ls-50">+8801601-153971</a>
                    </div>
                </div>
                <a class="wishlist label-down link d-xs-show" href="wishlist.html">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">Wishlist</span>
                </a>
                <a class="compare label-down link d-xs-show" href="compare.html">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">Compare</span>
                </a>
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">2</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>Shopping Cart</span>
                            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="products">
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Beige knitted
                                        elas<br>tic
                                        runner shoes</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$25.68</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('frontend') }}/images/cart/product-1.jpg" alt="product" height="84"
                                            width="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close" aria-label="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Blue utility
                                        pina<br>fore
                                        denim dress</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$32.99</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('frontend') }}/images/cart/product-2.jpg" alt="product" width="84"
                                            height="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close" aria-label="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">$58.67</span>
                        </div>

                        <div class="cart-action">
                            <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static"
                            title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                @foreach ($category as $item)
                                @php
                                    $subcategory=DB::table('subcategories')->where('category_id', $item->id)->get();
                                @endphp
                                <li>                                    
                                    <a href="#"> <i class="w-icon-tshirt2"></i>{{$item->category_name}} </a>                                                                     
                                    <ul class="menu vertical-menu category-menu" style="margin-top: -40px!important">
                                        @foreach ($subcategory as $item)
                                        @php
                                            $childcategory=DB::table('childcategories')->where('subcategory_id', $item->id)->get();
                                        @endphp
                                        <li class="has-submenu">
                                            <a href="#">{{$item->subcategory_name}}</a>
                                            <ul class="menu vertical-menu category-menu child-menu">
                                            {{-- <ul class="menu vertical-menu category-menu" style="margin-top: -40px!important"> --}}
                                                @foreach ($childcategory as $item)
                                                <li>
                                                    <a href="#">{{$item->childcategory_name}}</a>
                                                </li>
                                                @endforeach                                               
                                            </ul>
                                        </li>  
                                        @endforeach                                                                              
                                    </ul>
                                </li>
                                @endforeach  
                            </ul>
                        </div>
                    </div>
                    {{-- Home Shop Vendor Blog Page --}}
                    <nav class="main-nav">
                        <ul class="menu active-underline">
                            <li class="active">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li>
                                <a href="#">Shop</a>                               
                            </li>
                            <li>
                                <a href="#">Campaign</a>
                            </li>
                            <li>
                                <a href="#">Blog</a>
                            </li>
                            <li>
                                <a href="#">Helpline</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    {{-- Home Shop Vendor Blog Page --}}
                </div>
                <div class="header-right">
                    <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                    <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                </div>
            </div>
        </div>
    </div>
</header>