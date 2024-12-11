<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend') }}/img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="{{ asset('frontend') }}/css/font-awesome.min.css" rel="stylesheet">
    <!-- helper class css -->
    <link href="{{ asset('frontend') }}/css/helper.min.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="{{ asset('frontend') }}/css/plugins.css" rel="stylesheet">
    <!-- Toastr CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/toastr/toastr.css') }}">
    <!-- Main Style CSS -->
    <link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/skin-default.css" rel="stylesheet" id="galio-skin">
</head>

<body>
    <!-- color switcher start -->
    <div class="color-switcher">
        <div class="color-switcher-inner">
            <div class="switcher-icon">
                <i class="fa fa-cog fa-spin"></i>
            </div>

            <div class="switcher-panel-item">
                <h3>Color Schemes</h3>
                <ul class="nav flex-wrap colors">
                    <li class="default active" data-color="default" data-toggle="tooltip" data-placement="top" title="Red"></li>
                    <li class="green" data-color="green" data-toggle="tooltip" data-placement="top" title="Green"></li>
                    <li class="soft-green" data-color="soft-green" data-toggle="tooltip" data-placement="top" title="Soft-Green"></li>
                    <li class="sky-blue" data-color="sky-blue" data-toggle="tooltip" data-placement="top" title="Sky-Blue"></li>
                    <li class="orange" data-color="orange" data-toggle="tooltip" data-placement="top" title="Orange"></li>
                    <li class="violet" data-color="violet" data-toggle="tooltip" data-placement="top" title="Violet"></li>
                </ul>
            </div>

            <div class="switcher-panel-item">
                <h3>Layout Style</h3>
                <ul class="nav layout-changer">
                    <li><button class="btn-layout-changer active" data-layout="wide">Wide</button></li>
                    <li><button class="btn-layout-changer" data-layout="boxed">Boxed</button></li>
                </ul>
            </div>

            <div class="switcher-panel-item bg">
                <h3>Background Pattern</h3>
                <ul class="nav flex-wrap bgbody-style bg-pattern">
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-pettern/1.png" alt="Pettern"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-pettern/2.png" alt="Pettern"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-pettern/3.png" alt="Pettern"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-pettern/4.png" alt="Pettern"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-pettern/5.png" alt="Pettern"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-pettern/6.png" alt="Pettern"></li>
                </ul>
            </div>

            <div class="switcher-panel-item bg">
                <h3>Background Image</h3>
                <ul class="nav flex-wrap bgbody-style bg-img">
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-img/01.jpg" alt="Images"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-img/02.jpg" alt="Images"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-img/03.jpg" alt="Images"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-img/04.jpg" alt="Images"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-img/05.jpg" alt="Images"></li>
                    <li><img src="{{ asset('frontend') }}/img/bg-panel/bg-img/06.jpg" alt="Images"></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- color switcher end -->

    <div class="wrapper">

        <!-- header area start -->
        @yield('navbar')
        <!-- header area end -->

        @yield('content')

        <!-- footer area start -->
        <footer>
            <!-- footer top start -->
            <div class="footer-top bg-black pt-14 pb-14">
                <div class="container">
                    <div class="footer-top-wrapper">
                        <div class="newsletter__wrap">
                            <div class="newsletter__title">
                                <div class="newsletter__icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="newsletter__content">
                                    <h3>sign up for newsletter</h3>
                                    <p>Duis autem vel eum iriureDuis autem vel eum</p>
                                </div>
                            </div>
                            <div class="newsletter__box">
                                <form id="mc-form">
                                    <input type="email" id="mc-email" autocomplete="off" placeholder="Email">
                                    <button id="mc-submit">subscribe!</button>
                                </form>
                            </div>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                        <div class="social-icons">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer top end -->

            <!-- footer main start -->
            <div class="footer-widget-area pt-40 pb-38 pb-sm-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>contact us</h4>
                                </div>
                                <div class="widget-body">
                                    <ul class="location">
                                        <li><i class="fa fa-envelope"></i>support@galio.com</li>
                                        <li><i class="fa fa-phone"></i>(800) 0123 456 789</li>
                                        <li><i class="fa fa-map-marker"></i>Address: 1234 - Bandit Tringi Aliquam
                                            Vitae. New York</li>
                                    </ul>
                                    <a class="map-btn" href="contact-us.html">open in google map</a>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>my account</h4>
                                </div>
                                <div class="widget-body">
                                    <ul>
                                        <li><a href="#">my account</a></li>
                                        <li><a href="#">my cart</a></li>
                                        <li><a href="#">checkout</a></li>
                                        <li><a href="#">my wishlist</a></li>
                                        <li><a href="#">login</a></li>
                                    </ul>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>short code</h4>
                                </div>
                                <div class="widget-body">
                                    <ul>
                                        <li><a href="#">gallery</a></li>
                                        <li><a href="#">accordion</a></li>
                                        <li><a href="#">carousel</a></li>
                                        <li><a href="#">map</a></li>
                                        <li><a href="#">tab</a></li>
                                    </ul>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>product tags</h4>
                                </div>
                                <div class="widget-body">
                                    <ul>
                                        <li><a href="#">computer</a></li>
                                        <li><a href="#">camera</a></li>
                                        <li><a href="#">smart phone</a></li>
                                        <li><a href="#">watch</a></li>
                                        <li><a href="#">tablet</a></li>
                                    </ul>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                    </div>
                </div>
            </div>
            <!-- footer main end -->

            <!-- footer bootom start -->
            <div class="footer-bottom-area bg-gray pt-20 pb-20">
                <div class="container">
                    <div class="footer-bottom-wrap">
                        <div class="copyright-text">
                            <p>Copyright © 2024 khalifameditech Store. All Rights Reserved. Design by-<a data-toggle="tooltip" title="Sharif" target="_blank" href="https://dev.bdmppa.org/"> <span class="badge badge-danger text-white">Sharif</span></a></p>
                        </div>
                        <div class="payment-method-img">
                            <img src="{{ asset('frontend') }}/img/payment.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer bootom end -->

        </footer>
        <!-- footer area end -->

    </div>




    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->    


    <!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
    <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- Jquery Min Js -->
    <script src="{{ asset('frontend') }}/js/vendor/jquery-3.3.1.min.js"></script>
    <!-- Popper Min Js -->
    <script src="{{ asset('frontend') }}/js/vendor/popper.min.js"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('frontend') }}/js/vendor/bootstrap.min.js"></script>
    <!-- Plugins Js-->
    <script src="{{ asset('frontend') }}/js/plugins.js"></script>
     <!-- Toastr Core JS -->
    <script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>	
    <!-- sweetalert Core JS -->
	<script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>    
     
    <!-- Toastr Costome JS Code Write Start -->
    <script>
        @if(Session::has('messege'))
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
                }
        @endif
    </script>		
    {{-- before  logout showing alert message --}}
		<script>  
			$(document).on("click", "#logout", function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				   swal({
					 title: "Are you Want to logout?",
					 text: "",
					 icon: "warning",
					 buttons: true,
					 dangerMode: true,
				   })
				   .then((willDelete) => {
					 if (willDelete) {
						  window.location.href = link;
					 } else {
						swal({
							title: "Not logout",
							icon: "success",
				   		})
					 }
				   });
			   });
	   </script>   
   
    <!-- Ajax Mail Js -->
    <script src="{{ asset('frontend') }}/js/ajax-mail.js"></script>
    <!-- Active Js -->
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
    <script src="{{ asset('frontend') }}/js/switcher.js"></script>
    <script src="{{ asset('frontend') }}/js/custom.js"></script>
</body>



</html>