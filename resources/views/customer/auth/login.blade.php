<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('backend/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/css/AdminLTE.min.css') }}">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{route('customer')}}"><b>CUSTOMER LOGIN</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @include('includes.error')

            <form action="{{route('customer.login')}}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" value="{{old('email')?old('email'):''}}" placeholder="Email" required autocomplete="email" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                    <span class="invalid-feedback text-red" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                    <span class="invalid-feedback text-red" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-7 col-xs-offset-1">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a class="btn btn-link" href="">
                {{ __('I Forgot My Password?') }}
            </a>

            <div class="row">
                <div class="col-xs-12">
                    <a href="{{route('customer.register')}}" class="btn btn-success btn-flat btn-block">Create Account</a>
                    <a href="{{ route('customer.socialite','facebook') }}" class="btn btn-primary btn-flat btn-block"><i class="ti-facebook"></i>Sign in with facebook</a>
                    <a href="" class="btn btn-success btn-flat btn-block"><i class="ti-twitter"></i>Sign in with twitter</a>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>

</body>

</html>