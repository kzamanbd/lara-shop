<x-frontend-layout title="Home">
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            @if (session()->get('cart_status'))
                <div class="alert alert-success">
                    <b>{!! session()->get('cart_status') !!}</b>
                </div>
            @endif
            <!-- row -->
            <div class="row">
                @foreach ($categories->take(3) as $category)
                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>{{ $category->name }}<br>Collection</h3>
                                <a href="{{ route('category.products', ['slug' => $category->slug]) }}"
                                    class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('category.products', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            @foreach ($products as $product)
                                <div class="col-sm-3 col-xs-6">
                                    <!-- product -->
                                    <div class="product">
                                        <a href="{{ route('/product-details', ['slug' => $product->slug]) }}">
                                            <div class="product-img">
                                                <img src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="">
                                                <div class="product-label">
                                                    @php
                                                        $price = $product->product_price - $product->sale_price;
                                                        $parcentage = (100 * $price) / $product->product_price;
                                                    @endphp
                                                    <span class="sale">-{{ number_format($parcentage) }}%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="product-body">
                                            <p class="product-category">{{ $product->category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('/product-details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </h3>

                                            <h4 class="product-price"><span>৳</span>
                                                {{ number_format($product->sale_price, 2, '.', ',') }} <del
                                                    class="product-old-price">৳
                                                    {{ number_format($product->product_price, 2, '.', ',') }}</del>
                                            </h4>
                                            <div class="product-btns">
                                                <a href="" class="add-to-wishlist"><i
                                                        class="fa fa-heart-o"></i><span class="tooltipp">add to
                                                        wishlist</span></a>
                                                <a class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                        class="tooltipp">add to compare</span></a>
                                                <a class="quick-view"><i class="fa fa-eye"></i><span
                                                        class="tooltipp">quick view</span></a>
                                            </div>
                                        </div>
                                        <form action="{{ route('carts.store') }}" method="POST">
                                            @csrf
                                            <div class="add-to-cart">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="add-to-cart-btn"><i
                                                        class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /product -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    {{ $products->links() }}
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>04</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <!-- <li>
                    <div>
                     <h3>10</h3>
                     <span>Hours</span>
                    </div>
                   </li>
                   <li>
                    <div>
                     <h3>34</h3>
                     <span>Mins</span>
                    </div>
                   </li>
                   <li>
                    <div>
                     <h3>60</h3>
                     <span>Secs</span>
                    </div>
                   </li> -->
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 30% OFF</p>
                        <a class="primary-btn cta-btn" href="/">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('category.products', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            @foreach ($bastSales as $bastSale)
                                <div class="col-sm-4">
                                    <!-- product -->
                                    <div class="product">
                                        <a href="{{ route('/product-details', ['slug' => $bastSale->slug]) }}">
                                            <div class="product-img">
                                                <img src="{{ asset('uploads/products/' . $bastSale->image) }}"
                                                    alt="">
                                                <div class="product-label">
                                                    <span class="sale">-5%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="product-body">
                                            <p class="product-category">{{ $bastSale->category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('/product-details', ['slug' => $product->slug]) }}">{{ $bastSale->name }}</a>
                                            </h3>

                                            <h4 class="product-price"><span>৳</span>
                                                {{ number_format($bastSale->sale_price, 2, '.', ',') }} <del
                                                    class="product-old-price">৳
                                                    {{ number_format($bastSale->product_price, 2, '.', ',') }}</del>
                                            </h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <a href="" class="add-to-wishlist"><i
                                                        class="fa fa-heart-o"></i><span class="tooltipp">add to
                                                        wishlist</span></a>
                                                <a class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                        class="tooltipp">add to compare</span></a>
                                                <a class="quick-view"><i class="fa fa-eye"></i><span
                                                        class="tooltipp">quick view</span></a>
                                            </div>
                                        </div>
                                        <form action="{{ route('carts.store') }}" method="POST">
                                            @csrf
                                            <div class="add-to-cart">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="add-to-cart-btn"><i
                                                        class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /product -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    {{ $bastSales->links() }}
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

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

    <x-slot name="script">
        <script src="{{ asset('frontend/js/cart-action.js') }}"></script>
    </x-slot>
</x-frontend-layout>
