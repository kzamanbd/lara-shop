@extends('customer.layouts.app')
@section('title', 'Order Details')
@section('content')
    <div class="orderDetails">
        <section class="content-header">
            <h1>Customer App</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Order Details</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Order Details Invoice</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Product Shipping Details</h5>
                            <div class="table-responsive table-rounded">
                                <table class="tw-table table-bordered">
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Zip Code</th>
                                        <th>Payment Status</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $orderDetails->id }}</td>
                                        <td>{{ $orderDetails->first_name . ' ' . $orderDetails->last_name }}</td>
                                        <td>{{ $orderDetails->upazala->bn_name . ', ' . $orderDetails->district->bn_name . ', ' . $orderDetails->division->bn_name }}
                                        </td>
                                        <td>{{ $orderDetails->phone }}</td>
                                        <td>{{ $orderDetails->customer->email }}</td>
                                        <td>{{ $orderDetails->zip_code }}</td>
                                        <td>{{ $orderDetails->payment_status == 0 ? 'Pending' : 'Success' }}</td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Bill Details</h5>
                            <div class="table-responsive table-rounded">
                                <table class="tw-table table-bordered">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Order Time</th>
                                        <th>Delivery Date</th>
                                        <th>Total Price</th>
                                    </tr>
                                    @foreach ($orderDetails->order->billings as $productBill)
                                        <tr>
                                            <td>{{ $productBill->product->name }}</td>
                                            <td>{{ $productBill->quantity }}</td>
                                            <td>৳ {{ number_format($productBill->product_unit_price, 2, '.', ',') }}</td>
                                            <td>{{ $productBill->created_at->format('d M Y') }}</td>
                                            <td>{{ $productBill->created_at }}</td>
                                            <td>৳
                                                {{ number_format($productBill->product_unit_price * $productBill->quantity, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4"></td>
                                        <th>Total Amount</th>
                                        <td>BDT: ৳ {{ number_format($orderDetails->order->sub_total, 2, '.', ',') }} Tk
                                            only
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
