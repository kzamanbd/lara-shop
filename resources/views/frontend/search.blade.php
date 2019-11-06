@extends('frontend.layouts.app')
@section('title')
	Search
@endsection

@section('content')
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			@if (session()->get('cart_status'))
				<div class="alert alert-success">
					<b>{!! session()->get('cart_status')!!}</b>
				</div>
			@endif
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Search Result: {{Request::get('search')}} </h3>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							@forelse ($products as $product)
								<div class="col-sm-3">
									<!-- product -->
									<div class="product">
										<a href="{{ route('/product-details',['slug' => $product->slug]) }}">
											<div class="product-img">
												<img src="{{asset('uploads/products/'.$product->product_image)}}" alt="">
												<div class="product-label">
													<span class="sale">-5%</span>
													<span class="new">NEW</span>
												</div>
											</div>
										</a>
										<div class="product-body">
											<p class="product-category">{{$product->category->name}}</p>
											<h3 class="product-name"><a href="{{ route('/product-details',['slug' => $product->slug]) }}">{{$product->name}}</a></h3>

											<h4 class="product-price"><span>৳</span> {{number_format($product->product_price, 2,'.', ',')}} <del class="product-old-price">৳ {{number_format($product->sale_price, 2,'.', ',')}}</del></h4>
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
									<!-- /product -->
								</div>
							@empty
								<div class="alert alert-danger">
									<p>{{ucwords(Request::get('search'))}} Error! Not Found</p>
								</div>
							@endforelse
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
@endsection