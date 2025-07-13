<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="Anil z" name="author">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
            content="Shopwise is Powerful features and You Can Use The Perfect Build this Template For Any eCommerce Website. The template is built for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
        <meta name="keywords"
            content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">

        <!-- SITE TITLE -->
        <title>{{ $title }} - Shopping</title>
        <!-- Favicon Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storefront/images/favicon.png') }}">
        <!-- Animation CSS -->
        <link rel="stylesheet" href="{{ asset('storefront/css/animate.css') }}">
        <!-- Latest Bootstrap min CSS -->
        <link rel="stylesheet" href="{{ asset('storefront/vendor/bootstrap/css/bootstrap.min.css') }}">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap"
            rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap"
            rel="stylesheet">
        <!-- Icon Font CSS -->
        <link rel="stylesheet" href="{{ asset('storefront/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/simple-line-icons.css') }}">
        <!--- owl carousel CSS-->
        <link rel="stylesheet" href="{{ asset('storefront/vendor/owlcarousel/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/vendor/owlcarousel/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/vendor/owlcarousel/css/owl.theme.default.min.css') }}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{ asset('storefront/css/magnific-popup.css') }}">
        <!-- Slick CSS -->
        <link rel="stylesheet" href="{{ asset('storefront/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/slick-theme.css') }}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('storefront/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('storefront/css/responsive.css') }}">

    </head>

    <body>

        <!-- LOADER -->
        <div class="preloader">
            <div class="lds-ellipsis">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- END LOADER -->

        @include('storefront.layouts.header')

        <!-- END MAIN CONTENT -->
        {{ $slot }}
        <!-- END MAIN CONTENT -->

        <!-- START FOOTER -->
        @include('storefront.layouts.footer')
        <!-- END FOOTER -->

        <a href="#" class="scrollup" style="display: none;">
            <i class="ion-ios-arrow-up"></i>
        </a>

        <!-- Latest jQuery -->
        <script src="{{ asset('storefront/js/jquery-3.7.1.min.js') }}"></script>
        <!-- popper min js -->
        <script src="{{ asset('storefront/js/popper.min.js') }}"></script>
        <!-- Latest compiled and minified Bootstrap -->
        <script src="{{ asset('storefront/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- owl-carousel min js  -->
        <script src="{{ asset('storefront/vendor/owlcarousel/js/owl.carousel.min.js') }}"></script>
        <!-- magnific-popup min js  -->
        <script src="{{ asset('storefront/js/magnific-popup.min.js') }}"></script>
        <!-- waypoints min js  -->
        <script src="{{ asset('storefront/js/waypoints.min.js') }}"></script>
        <!-- parallax js  -->
        <script src="{{ asset('storefront/js/parallax.js') }}"></script>
        <!-- countdown js  -->
        <script src="{{ asset('storefront/js/jquery.countdown.min.js') }}"></script>
        <!-- imagesloaded js -->
        <script src="{{ asset('storefront/js/imagesloaded.pkgd.min.js') }}"></script>
        <!-- isotope min js -->
        <script src="{{ asset('storefront/js/isotope.min.js') }}"></script>
        <!-- jquery.dd.min js -->
        <script src="{{ asset('storefront/js/jquery.dd.min.js') }}"></script>
        <!-- slick js -->
        <script src="{{ asset('storefront/js/slick.min.js') }}"></script>
        <!-- elevatezoom js -->
        <script src="{{ asset('storefront/js/jquery.elevatezoom.js') }}"></script>
        <!-- scripts js -->
        <script src="{{ asset('storefront/js/scripts.js') }}"></script>

    </body>

</html>
