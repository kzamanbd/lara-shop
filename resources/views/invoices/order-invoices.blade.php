<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="text/css" href="{{ asset('frontend/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Invoices</title>
</head>

<body class="bg-light">

    <div class="container-fluid">
        <div class="bg-success">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo ml-3">
                        <img src="{{ asset('frontend/img/logo.png') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="invoice float-right">
                        <h2 class="title p-3">Invoices</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Shipping Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="tw-table table-hover table-bordered">
                            <thead style="background: #B32C39; color: #fff">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>Zip Code</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>{{ $order_details->id }}</td>
                                <td>{{ $order_details->first_name . ' ' . $order_details->last_name }}</td>
                                <td>{{ $order_details->upazala->bn_name . ', ' . $order_details->district->bn_name . ', ' . $order_details->division->bn_name }}
                                </td>
                                <td>{{ $order_details->phone }}</td>
                                <td>{{ $order_details->email }}</td>
                                <td>{{ $order_details->zip_code }}</td>
                                <td>{{ $order_details->payment_status == 0 ? 'Pending' : 'Success' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="tw-table table-hover table-bordered">
                            <thead style="background: #B32C39; color: #fff">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Order Time</th>
                                    <th>Delivery Date</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Billing::where('sale_id', $sale_details->id)->get() as $productBill)
                                    <tr>
                                        <td>{{ App\Models\Product::where('id', $productBill->product_id)->first()->name }}
                                        </td>
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
                                    <th>Shipping Cost</th>
                                    <td>BDT: ৳
                                        @if ($order_details->shipping_method == 'next_day_delivery')
                                            150
                                        @elseif($order_details->shipping_method == 'standard_delivery')
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
                                    <td>BDT: ৳ {{ number_format($sale_details->sub_total, 2, '.', ',') }} Tk only</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
