@extends('customer.layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="dashboard">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Customer App</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="grid grid-cols-3 gap-4 mb-4">

                <div class="card">
                    <div class="card-body">
                        <span class="info-card-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                        <span class="info-card-text">Buy Amount:</span>
                        <span class="info-card-number">{{ number_format($orders->sum('sub_total'), 2, '.', ',') }}
                            <small>৳</small></span>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-body">
                        <span class="info-card-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                        <span class="info-card-text">Total Orders:</span>
                        <span class="info-card-number">{{ $orders->count() }}</span>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-body">
                        <span class="info-card-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                        <span class="info-card-text">Total Refund:</span>
                        <span class="info-card-number">0</span>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5>Welcome <em>{{ ucwords(Auth::user()->name) }}</em>!. Your Order Details</h5>
                        </div>
                        <div class="card-body table-rounded">
                            <table class="tw-table table-bordered">
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
                                                <a href="{{ route('customer.order.details', $order->shipping_id) }}"
                                                    class="btn btn-outline-success btn-sm">Order Details <i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('customer.order.cancel', $order->id) }}"
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
