@extends('backend.layouts.app')
@section('title', 'Order Details Details')
@section('content')
    <div class="orderDetails-details">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Order Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h4>Order Details Details Invoice</h4>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Product Shipping Details</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-borderDetailsed">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <th>Zip Code</th>
                                            <th>Payment Status</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $orderDetails->id }}</td>
                                            <td>{{ $orderDetails->name }}</td>
                                            <td>{{ $orderDetails->upazala->bn_name . ', ' . $orderDetails->district->bn_name . ', ' . $orderDetails->division->bn_name }}
                                            </td>
                                            <td>{{ $orderDetails->phone }}</td>
                                            <td>{{ $orderDetails->email }}</td>
                                            <td>{{ $orderDetails->zip_code }}</td>
                                            <td>{{ $orderDetails->payment_status == 0 ? 'Pending' : 'Success' }}</td>
                                        </tr>
                                    </table>
                                </div>

                            </div>

                            <div class="card-body">
                                <h4>Bill Details</h4>
                                <div class="table-responsive">
                                    <table class="table table-borderDetailsed">
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
                                                <td>৳ {{ number_format($productBill->product_unit_price, 2, '.', ',') }}
                                                </td>
                                                <td>{{ $productBill->created_at->format('d M Y') }}</td>
                                                <td>{{ $productBill->created_at }}</td>
                                                <td>৳
                                                    {{ number_format($productBill->product_unit_price * $productBill->quantity, 2, '.', ',') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4"></td>
                                            <th>Shipping Cost</th>
                                            <td>BDT: ৳
                                                @if ($orderDetails->shipping_method == 'next_day_delivery')
                                                    150
                                                @elseif($orderDetails->shipping_method == 'standard_delivery')
                                                    50
                                                @else
                                                    0.00
                                                @endif
                                                Tk only
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <th>Total Amount</th>
                                            <td>BDT: ৳ {{ number_format($orderDetails->order->sub_total, 2, '.', ',') }} Tk
                                                only</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td><a href="{{ route('admin.order.invoice', $orderDetails->id) }}"
                                                    class="btn btn-flat btn-primary btn-block">Print</a></td>
                                            <td><a href="" class="btn btn-flat btn-primary btn-block">Download</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
