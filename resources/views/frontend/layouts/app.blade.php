<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<title>@yield('title') :: EshopBd</title>
		<link rel="icon" type="text/css" href="{{ asset('frontend/favicon.png') }}">
		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}"/>
		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('frontend/css/toastr.min.css')}}">
		@stack('stylesheet')
		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- Page Preloder -->
		<div id="preloder">
			<div class="loader"></div>
		</div>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						@php
							$settings = App\Models\Setting::take(1)->orderBy('id', 'DESC')->first();
						@endphp
						<li><a href="tel:{{$settings?$settings->phone:'+8801721279141'}}"><i class="fa fa-phone"></i> {{$settings?$settings->phone:'+8801721279141'}}</a></li>
						<li><a href="mailto:{{$settings?$settings->email:'zaman7.info@gmail.com'}}"><i class="fa fa-envelope-o"></i> {{$settings?$settings->email:'zaman7.info@gmail.com'}}</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> {{$settings?$settings->address:'Mymensingh, Bangladesh'}}</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> BDT</a></li>
						@if (Auth::guard('customer')->check())
							<li><a href="{{route('customer')}}" target="_blank"><i class="fa fa-user-o"></i> My Account</a></li>
							<li><a href="{{ route('customer.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a></li>
							<form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
	                            @csrf
	                        </form>
						@else
							<li><a href="{{ route('customer.register') }}"><i class="fa fa-user-o"></i> Register</a></li>
							<li><a href="{{route('customer.login')}}"><i class="fa fa-user-o"></i> Login</a></li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			@php
				$categories = App\Models\Category::where('status', 1)->get();
			@endphp
			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{ route('/') }}" class="logo">
									<img src="{{asset('frontend/img/logo.png')}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{route('search.show')}}" method="GET">
									<select class="input-select" id="category" name="category">
										<option value="all" selected="">All Categories</option>
										@foreach ($categories as $category)
											<option value="{{$category->slug}}">{{$category->name}}</option>
										@endforeach
									</select>
									<input class="input" name="search" placeholder="Search here" id="search-input">
									<button type="submit" class="search-btn">Search</button>
								</form>
                                <div class="search-result">
                                    <ul id="search_result">
                                    </ul>
                                </div>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Wishlist</span>
										<div class="qty">0</div>
									</a>
								</div>
								<!-- /Wishlist -->
								<!-- Cart -->
								<div class="dropdown">
									@php
										$subTotal = 0;
										$totalQty = 0;
										$totalPrice = 0;
										$carts = App\Models\Cart::where('session_id', session()->getId())->get();
										$count_qty = count($carts);
									@endphp
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{$count_qty}}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											@forelse ($carts as $cart)
												<div class="product-widget">
													<div class="product-img">
														<img src="{{asset('uploads/products/'.$cart->product->image)}}" alt="">
													</div>
													<div class="product-body">
														<h3 class="product-name"><a href="{{ route('/product-details',['slug' => $cart->product->slug]) }}">{{$cart->product->name}}</a></h3>
														<h4 class="product-price"><span class="qty">{{$cart->quantity}} x
															@php
																$price = $cart->product->sale_price*$cart->quantity;
																$totalQty = $totalQty + $cart->quantity;
																$totalPrice = $cart->product->sale_price * $totalQty;
																$subTotal = $subTotal + $price;
															@endphp
														</span>৳{{number_format($price, 2,'.', ',')}}</h4>
													</div>
													<a href="{{ route('carts.destroy',['id' => $cart->id]) }}" class="delete"><i class="fa fa-close"></i></a>
												</div>
											@empty
												<div class="product-widget">
													<p>No Product is Here!</p>
												</div>
											@endforelse
										</div>
										<div class="cart-summary">
											<small>{{$count_qty}} Item(s) selected</small>
											<h5>SUBTOTAL: ৳ {{number_format($subTotal,2,'.',',')}}</h5>
										</div>
										<div class="cart-btns">
											@if ($count_qty < 1)
												<a href="{{ route('carts.index') }}">Cart Empty <i class="fa fa-shopping-bag"></i></a>
											@else
												<a href="{{ route('carts.index') }}">View Cart <i class="fa fa-shopping-bag"></i></a>
											@endif
											<a href="">Clear Carts  <i class="fa fa-times"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->

					<ul class="main-nav nav navbar-nav">
						<li class="{{Request::is('/')?'active':''}}"><a href="{{ route('/') }}">Home</a></li>
						@foreach ($categories as $category)
							<li class="{{Request::is('products/'.$category->slug) == $category->slug?'active':''}}"><a href="{{ route('category.products',['slug' => $category->slug]) }}">{{$category->name}}</a></li>
						@endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		@yield('content')

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>{{Str::words($settings?$settings->about_us:'Lorem',20)}}</p>
								<ul class="footer-links">
									<li><a href="tel:{{$settings?$settings->phone:'+8801721279141'}}"><i class="fa fa-phone"></i> {{$settings?$settings->phone:'+8801721279141'}}</a></li>
									<li><a href="mailto:{{$settings?$settings->email:'zaman7.info@gmail.com'}}"><i class="fa fa-envelope-o"></i> {{$settings?$settings->email:'zaman7.info@gmail.com'}}</a></li>
									<li><a href="#"><i class="fa fa-map-marker"></i> {{$settings?$settings->address:'Mymensingh, Bangladesh'}}</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									@foreach ($categories as $category)
										<li><a href="#">{{$category->name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="{{route('customer')}}">My Account</a></li>
									<li><a href="{{route('carts.index')}}">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://facebook.com/zaman7i" target="_blank">Zaman</a>
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- scripts -->
		<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
		<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('frontend/js/slick.min.js')}}"></script>
		<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
		<script src="{{asset('frontend/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('frontend/js/toastr.min.js')}}"></script>
    	<script type="text/javascript">
			toastr.options.closeButton = true;
            toastr.options.progressBar = true;
	        @include('includes.toastr')
	    </script>
		@stack('javascript')
		<script src="{{asset('frontend/js/main.js')}}"></script>

	</body>
</html>

