@extends('frontend.layouts.app')
@section('title')
	{{$product->name}}
@endsection

@section('content')
		<!-- BREADCRUMB -->
	<div id="breadcrumb" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb-tree">
						<li><a href="{{ route('/') }}">Home</a></li>
						<li><a href="#">All Categories</a></li>
						<li><a href="{{ route('category.products',['slug' => $product->category->slug]) }}">{{$product->category->name}}</a></li>
						<li class="active">{{$product->name}}</li>
					</ul>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /BREADCRUMB -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- Product main img -->
				<div class="col-md-5 col-md-push-2">
					<div id="product-main-img">
						<div class="product-preview">
							<img src="{{ asset('uploads/products/'.$product->image) }}" alt="Image">
						</div>
						@foreach($product->productImages as $productImage)
							<div class="product-preview">
								<img src="{{ asset('uploads/products/'.$productImage->image) }}" alt="Image">
							</div>
						@endforeach
					</div>
				</div>
				<!-- /Product main img -->

				<!-- Product thumb imgs -->
				<div class="col-md-2  col-md-pull-5">
					<div id="product-imgs">
						<div class="product-preview">
							<img src="{{ asset('uploads/products/'.$product->image) }}" alt="Image">
						</div>
						@foreach($product->productImages as $productImage)
							<div class="product-preview">
								<img src="{{ asset('uploads/products/'.$productImage->image) }}" alt="Image">
							</div>
						@endforeach
					</div>
				</div>
				<!-- /Product thumb imgs -->

				<!-- Product details -->
				<div class="col-md-5">
					<div class="product-details">
						<h2 class="product-name">{{$product->name}}</h2>
						<div>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
							</div>
							<a class="review-link" href="#">10 Review(s) | Add your review</a>
						</div>
						<div>
							<h3 class="product-price"><span>৳</span> {{number_format($product->sale_price, 2,'.', ',')}} <del class="product-old-price">৳ {{number_format($product->product_price, 2,'.', ',')}}</del></h3>
							<span class="product-available">{{($product->quantity > 0)?'In Stock '.$product->quantity:'Out Of Stock'}}</span>
						</div>
						{!! Str::words($product->description, 30)!!}<br><br>

						<form action="{{route('carts.store')}}" method="POST">
							@csrf
							<div class="row">
								<div class="col-sm-6">
									<div class="product-options" style="margin-top: 0px">
										<input type="hidden" name="product_id" value="{{$product->id}}">
										<label>
											Color
											<select class="input-select" name="product_color">
												<option value="1">{{$product->product_color}}</option>
											</select>
										</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="add-to-cart">
										<div class="qty-label">
											Qty
											<div class="input-number">
												<input type="number" name="quantity" value="1">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="add-to-cart">
								<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</form>

						<ul class="product-btns">
							<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
							<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
						</ul>

						<ul class="product-links">
							<li>Category:</li>
							<li><a href="#">{{$product->category->name}}</a></li>
						</ul>

						<ul class="product-links">
							<li>Share:</li>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-envelope"></i></a></li>
						</ul>

					</div>
				</div>
				<!-- /Product details -->

				<!-- Product tab -->
				<div class="col-md-12">
					<div id="product-tab">
						<!-- product tab nav -->
						<ul class="tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							<li><a data-toggle="tab" href="#reviews">Reviews (3)</a></li>
						</ul>
						<!-- /product tab nav -->

						<!-- product tab content -->
						<div class="tab-content">
							<!-- tab1  -->
							<div id="tab1" class="tab-pane fade in {{$errors->any()?'':'active'}}">
								<div class="row">
									<div class="col-md-12">
										{!! $product->description !!}
									</div>
								</div>
							</div>
							<!-- /tab1  -->

							<!-- tab3  -->
							<div id="reviews" class="tab-pane fade in {{$errors->any()?'active':''}}">
								@include('includes.error')
								<div class="row">
									<!-- Rating -->
									<div class="col-md-3">
										<div id="rating">
											<div class="rating-avg">
												<span>4.5</span>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</div>
											<ul class="rating">
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													<div class="rating-progress">
														<div style="width: 80%;"></div>
													</div>
													<span class="sum">3</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div style="width: 60%;"></div>
													</div>
													<span class="sum">2</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div></div>
													</div>
													<span class="sum">0</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div></div>
													</div>
													<span class="sum">0</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div></div>
													</div>
													<span class="sum">0</span>
												</li>
											</ul>
										</div>
									</div>
									<!-- /Rating -->

									<!-- Reviews -->
									<div class="col-md-6">
										<div id="reviews">
											<ul class="reviews">
												<li>
													<div class="review-heading">
														<h5 class="name">John</h5>
														<p class="date">27 DEC 2018, 8:0 PM</p>
														<div class="review-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
													</div>
												</li>
												<li>
													<div class="review-heading">
														<h5 class="name">John</h5>
														<p class="date">27 DEC 2018, 8:0 PM</p>
														<div class="review-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
													</div>
												</li>
												<li>
													<div class="review-heading">
														<h5 class="name">John</h5>
														<p class="date">27 DEC 2018, 8:0 PM</p>
														<div class="review-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
													</div>
												</li>
											</ul>
											<ul class="reviews-pagination">
												<li class="active">1</li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
												<li><a href="#">4</a></li>
												<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- /Reviews -->

									<!-- Review Form -->
									<div class="col-md-3">
										<div id="review-form">
											<form action="{{ route('review.store') }}" class="review-form" method="post">
												@csrf
												<input type="hidden" name="product_id" value="{{$product->id}}">
												<input class="input" name="name" type="text" placeholder="Your Name" value="{{old('name')}}">
												<input class="input" name="email" type="email" placeholder="Your Email" value="{{old('email')}}">
												<textarea class="input" name="description" placeholder="Your Review" value="{{old('description')}}"></textarea>
												<div class="input-rating">
													<span>Your Rating: </span>
													<div class="stars">
														<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
													</div>
												</div>
												<button type="submit" class="primary-btn">Submit</button>
											</form>
										</div>
									</div>
									<!-- /Review Form -->
								</div>
							</div>
							<!-- /tab3  -->
						</div>
						<!-- /product tab content  -->
					</div>
				</div>
				<!-- /product tab -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- Section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<div class="col-md-12">
					<div class="section-title text-center">
						<h3 class="title">Related Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								@foreach ($categories as $category)
									<li><a href="{{ route('category.products',['slug' => $category->slug]) }}">{{$category->name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>

				@forelse ($relatedProducts as $relatedProduct)
				<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<a href="{{ route('/product-details',['slug' => $relatedProduct->slug]) }}">
								<div class="product-img">
									<img src="{{asset('uploads/products/'.$product->image)}}" alt="">
									<div class="product-label">
										<!-- <span class="sale">-30%</span> -->
										<span class="new">NEW</span>
									</div>
								</div>
							</a>
							<div class="product-body">
								<p class="product-category">{{$relatedProduct->category->name}}</p>
								<h3 class="product-name"><a href="#">{{$relatedProduct->name}}</a></h3>
								<h4 class="product-price"><span>৳</span> {{number_format($relatedProduct->product_price, 2,'.', ',')}} <del class="product-old-price">৳ {{number_format($relatedProduct->product_price*5/100, 2,'.', ',')}}</del></h4>
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
									<input type="hidden" name="product_id" value="{{$relatedProduct->id}}">
									<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
								</div>
							</form>
						</div>
					</div>
				<!-- /product -->
				@empty
					<div class="alert alert-denger">No Related Product</div>
				@endforelse

			</div>
			<!-- /row -->
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