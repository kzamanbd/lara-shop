@extends('frontend.layouts.app')
@section('title', 'Cart')

@push('stylesheet')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">
@endpush
@section('content')

	<div id="breadcrumb" class="section">
	<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="breadcrumb-box">
						<ul class="breadcrumb-tree">
						<li><a href="{{ route('/') }}">Home</a></li>
						<li class="active">Cart</li>
					</ul>
					<img src="{{ asset('frontend/img/page-info-art.png') }}" alt="" class="page-info-art">
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
		<!-- Page -->
	<div class="cart-info">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="cart-table">
                        @if (session()->get('cart_status'))
                            <div class="alert alert-info">
                                {{session()->get('cart_status')}}
                            </div>
                        @endif
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @php
                                $subTotal = 0;
                                $totalQty = 0;
                                $totalPrice = 0;
                            @endphp

                            @forelse ($carts as $cart)
                                <tr>
                                    <td><img src="{{asset('uploads/products/'.$cart->product->image)}}" width="80px" alt=""></td>
                                    <td><a href="#">{{$cart->product->name}}</a></td>
                                    <td>{{number_format($cart->product->sale_price, 2,'.', ',')}}</td>
                                    <td><span class="badge">{{$cart->quantity}}</span></td>
                                    <td>{{number_format($cart->product->sale_price*$cart->quantity, 2,'.', ',')}}</td>
                                    <td class="text-center"><a href="{{ route('carts.destroy',$cart->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @php
                                    $price = $cart->product->sale_price*$cart->quantity;
                                    $totalQty = $totalQty + $cart->quantity;
                                    $totalPrice = $cart->product->sale_price * $totalQty;
                                    $subTotal = $subTotal + $price;
                                @endphp
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Products</td>
                                </tr>
                            @endforelse
                        </table>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="shipping-btn-c">
                                    <h3><a  class="btn btn-success" href="{{ route('/') }}">Continue Shopping</a></h3>
                                </div>
                            </div>
                            <div class="col-sm-2 col-sm-offset-6">
                                <div class="shipping-btn-c">
                                    @if(!empty($carts))
                                        <h3><a href="" class="btn btn-danger pull-right">Clear Carts</a></h3>
                                    @endif
                                </div>
                            </div>
                        </div>

						<hr>
						<div class="row">
							<form action="{{ route('checkout') }}" method="POST">
								@csrf
								<div class="col-sm-6">
									<div class="shipping-info">
										<h2>Shipping method</h2>
										<p>Select the one you want</p>
										<div class="shipping-chooes">
											<div class="sc-item">
												<input type="radio" name="shipping_method" id="one" value="next_day_delivery">
												<label for="one" id="method_one">Next day delivery<span>৳ 150 BDT</span></label>
											</div>
											<div class="sc-item">

												<input type="radio" name="shipping_method" id="two" value="standard_delivery">
												<label for="two" id="method_two">Standard delivery<span>৳ 50 BDT</span></label>
											</div>
											<div class="sc-item">
												<input type="radio" name="shipping_method" id="three" value="personal_pickup">
												<label for="three" id="method_three">Personal Pickup<span>Free</span></label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="cart-total-details">
										<h2>Total</h2>
										<p>Final Info</p>
										@error('sub_total')
				                            <div class="alert alert-danger" role="alert">
				                                <strong>{{ $message }}</strong>
				                            </div>
				                        @enderror
										
										<ul class="cart-total-card">
											<li>Total: <span>৳ {{number_format($subTotal,2,'.',',')}}</span></li>
											<li>Shipping<span id="set_shipping_value">00.0</span><span>৳ </span></li>
											<input type="hidden" name="total_qty" value="{{$totalQty}}">
											<input type="hidden" id="total" value="{{$subTotal}}">
											<input type="hidden" name="sub_total" id="sub_total">
											<li class="total">Subtotal<span id="grand_total">{{number_format($subTotal,2,'.',',')}}</span><span>৳</span></li>
										</ul>
										<button type="submit" class="btn btn-block btn-success">Proceed to checkout</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page end -->
@endsection
@push('javascript')
	<script type="text/javascript">
		$(document).ready(function(){

			$('#method_one').click(function(){
				var shipping_one = parseFloat(150.00);
				$('#set_shipping_value').html(parseFloat(shipping_one).toFixed(2));
				var total = parseFloat($('#total').val());
				var grand_total = shipping_one + total;
				$('#sub_total').val(parseFloat(grand_total).toFixed(2));
				$('#grand_total').html(parseFloat(grand_total).toFixed(2));
			});

			$('#method_two').click(function(){
				var shipping_one = parseFloat(50.00);
				$('#set_shipping_value').html(parseFloat(shipping_one).toFixed(2));
				var total = parseFloat($('#total').val());
				var grand_total = shipping_one + total;
				$('#sub_total').val(parseFloat(grand_total).toFixed(2));
				$('#grand_total').html(parseFloat(grand_total).toFixed(2));
			});

			$('#method_three').click(function(){
				var shipping_one = parseFloat(0.00);
				$('#set_shipping_value').html(parseFloat(shipping_one).toFixed(2));
				var total = parseFloat($('#total').val());
				var grand_total = shipping_one + total;
				$('#sub_total').val(parseFloat(grand_total).toFixed(2));
				$('#grand_total').html(parseFloat(grand_total).toFixed(2));
			});
		});
	</script>
@endpush