@extends('components.layouts.app', ['title' => 'Orders'])

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5>Orders</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="tw-table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL</th>
                                            <th>Customer Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Shipping Method</th>
                                            <th>Payment Status</th>
                                            <th>Order Time</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr class=" {{ $order->status == 0 ? 'bg-light' : '' }}">
                                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                                <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->upazala->name . ', ' . $order->district->name . ', ' . $order->division->name }}
                                                </td>
                                                <td>{{ ucwords(str_replace('_', ' ', $order->shipping_method)) }}</td>
                                                <td>{{ $order->payment_status == 0 ? 'Pending' : 'Success' }}</td>
                                                <td>{{ $order->created_at->DiffForHumans() }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.order.details', $order->id) }}"
                                                            class="btn btn-success btn-sm"><i class="fa fa-eye"
                                                                aria-hidden="true"></i> View</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No Data In this Table</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- {{$orders->links()}} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
