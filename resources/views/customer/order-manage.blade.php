@extends('customer.layouts.app')
@section('title','Order List')

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
            <li class="active">Orders Manage</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="card-title">Products Manage Table</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">SL No</th>
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
                                        <tr class=" {{$order->status == 0 ? 'bg-light': ''}}">
                                            <td class="text-center">{{$loop->index+1}}</td>
                                            <td>{{$order->first_name.' '.$order->last_name}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->upazala->name.', '.$order->district->name.', '.$order->division->name}}</td>
                                            <td>{{ucwords(str_replace('_', ' ',$order->shipping_method))}}</td>
                                            <td>{{$order->payment_status == 0 ? 'Pending':'Success'}}</td>
                                            <td>{{$order->created_at->DiffForHumans()}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{route('admin.order.details',['order_id' => $order->id])}}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Order Details</a>
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
                                {{--{{$orders->links()}}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
