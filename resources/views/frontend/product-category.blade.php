
@extends('frontend.layouts.app')
@section('title')
	@if ($products)
		{{$products->first()->category->name}}
	@else
		Category Not Found
	@endif
@endsection
@section('content')
	<!-- Section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<div class="col-md-12">
					<div class="section-title text-center">
						<h3 class="title">
							@if ($products)
								{{$products->first()->category->name}}
							@else
								Category Not Found
							@endif
						</h3>
					</div>
				</div>

				@foreach ($products as $product)
				<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<a href="{{ route('/product-details',['slug' => $product->slug]) }}">
								<div class="product-img">
									<img src="{{ asset('uploads/products/'.$product->image) }}" alt="">
									<div class="product-label">
										@php
											$price = $product->product_price - $product->sale_price;
											$parcentage = 100*$price/$product->product_price
										@endphp
										<span class="sale">-{{number_format($parcentage)}}%</span>
										<span class="new">NEW</span>
									</div>
								</div>
							</a>
							<div class="product-body">
								<p class="product-category">{{$product->category->name}}</p>
								<h3 class="product-name"><a href="#">{{$product->name}}</a></h3>
								<h4 class="product-price"><span>৳</span> {{number_format($product->sale_price, 2,'.', ',')}} <del class="product-old-price">৳ {{number_format($product->product_price, 2,'.', ',')}}</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product-btns">
									<a href="" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></a>
									<a class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></a>
									<a class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></a>
								</div>
							</div>
							<form action="{{route('carts.store')}}" method="POST">
								@csrf
								<div class="add-to-cart">
									<input type="hidden" name="product_id" value="{{$product->id}}">
									<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
								</div>
							</form>
						</div>
					</div>
				<!-- /product -->
				@endforeach

			</div>
			<!-- /row -->
			{{$products->links()}}
		</div>
		<!-- /container -->
	</div>
	<!-- /Section -->

	<!-- NEWSLETTER -->
	<div id="newsletter" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="newsletter">
						<p>Sign Up for the <strong>NEWSLETTER</strong></p>
						<form>
							<input class="input" type="email" placeholder="Enter Your Email">
							<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
						</form>
						<ul class="newsletter-follow">
							<li>
								<a href="#"><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-instagram"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
		<!-- /NEWSLETTER -->
@endsection