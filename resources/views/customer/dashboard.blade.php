@extends('customer.layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="dashboard">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Customer
                <small>/ Eshop</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Buy Amount</span>
                            <span class="info-box-number">{{ number_format($orders->sum('sub_total'), 2, '.', ',') }}
                                <small>৳</small></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Orders</span>
                            <span class="info-box-number">{{ number_format($orders->count(), 2, '.', ',') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Customers</span>
                            <span class="info-box-number">{{ App\Models\Customer::all()->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4>Welcome <em>{{ ucwords(Auth::guard('customer')->user()->name) }}</em>!. Your Order Details
                            </h4>
                        </div>
                        <div class="box-body">
                            <table class="table table-hover table-bordered">
                                @forelse($orders as $order)
                                    <tr>
                                        <td colspan="6"><strong>Order Number: {{ $loop->index + 1 }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <th>Order Id</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                        <th>Order Details</th>
                                    </tr>
                                    <tr>
                                        <td>{{ ucwords(Auth::user()->name) }}</td>
                                        <td>{{ $order->shipping_id }}</td>
                                        <td>৳ {{ number_format($order->sub_total, 2, '.', ',') }}</td>
                                        <td>{{ $order->shipping->payment_status == 0 ? 'Pending' : 'Success' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('customer.order.details', ['order_id' => $order->shipping_id]) }}"
                                                    class="btn btn-outline-success btn-sm">Order Details <i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('customer.order.cancel', ['id' => $order->id]) }}"
                                                    class="btn btn-outline-danger btn-sm">Cancel <i class="fa fa-remove"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5"><strong>No Order</strong></td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
    </div>
@endsection
