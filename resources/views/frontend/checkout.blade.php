<x-frontend-layout title="Checkout">
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/checkout.css') }}">
    </x-slot>

    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-box">
                        <ul class="breadcrumb-tree">
                            <li><a href="{{ route('/') }}">Home</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                        <img src="{{ asset('frontend/img/page-info-art.png') }}" alt="" class="page-info-art">
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div class="page-area cart-page spad">
        <div class="container">
            <form class="checkout-form" action="{{ route('shipping') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="checkout-title">Billing Address</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" placeholder="Name *" name="name" value="{{ old('name') }}">
                                <input type="email" placeholder="Email Address *" name="email"
                                    value="{{ old('email') }}">
                                <input type="text" placeholder="Phone no *" name="phone"
                                    value="{{ old('phone') }}">
                                <select name="division_id" id="division_id">
                                    <option>Divisions *</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                    @endforeach
                                </select>
                                <select name="district_id" id="district_id">
                                    <option>District *</option>
                                </select>
                                <select name="upazila_id" id="upazila_id">
                                    <option>Upazila *</option>
                                </select>
                                <input type="text" placeholder="Union / Road No / House No / Address" name="address">
                                <input type="text" placeholder="Zipcode *" name="zip_code"
                                    value="{{ old('zip_code') }}">
                                @if (!Auth::check())
                                    <input type="checkbox" name="create_account" id="create_account"><label
                                        for="create_account">Create Account</label>
                                    <input type="password" placeholder="Password*" name="password" id="password">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="order-card">
                            <div class="order-details">
                                <div class="od-warp">
                                    <h4 class="checkout-title">Your order</h4>
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th>Total Product</th>
                                                <th>Shipping Method</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="order-total">
                                                <td>{{ $total_qty }}</td>
                                                <input type="hidden" value="{{ $sub_total }}" name="sub_total">
                                                <input type="hidden" value="{{ $shipping_method }}"
                                                    name="shipping_method">
                                                <td>{{ ucwords(str_replace('_', ' ', $shipping_method)) }}</td>
                                                <td>৳ {{ number_format($sub_total, 2, '.', ',') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="pm-item">
                                        <input type="radio" name="payment_type" id="one" value="cash" checked>
                                        <label for="one">Cash on Delivery</label>
                                    </div>
                                    <div class="pm-item">
                                        <input type="radio" name="payment_type" id="two" value="card">
                                        <label for="two">Credit card</label>
                                    </div>
                                </div>
                            </div>
                            <button class="site-btn btn-full" type="submit">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <x-slot name="script">
        <script src="{{ asset('frontend/js/checkout-action.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#password').hide();
                $('#create_account').on('click', function() {
                    $('#password').slideToggle();
                });
            });
        </script>
    </x-slot>

</x-frontend-layout>
