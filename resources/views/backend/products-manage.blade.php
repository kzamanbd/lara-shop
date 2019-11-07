@extends('backend.layouts.app')
@section('title','Products Manage')

@section('content')
    <div class="products">
        <section class="content-header">
          <h1>
            Manage Products
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Products</li>
          </ol>
        </section>

    	<div class="content">
    		<div class="row">
    	        <div class="col-md-12">
    	            <div class="box box-info">
                        <div class="box-header">
                            <h3>Products Manage Table
                            <a href="{{route('new.product')}}" class="btn btn-primary pull-right">New Product</a></h3>
                        </div>
                        <div class="box-body">
                            @include('includes.error')
                            @include('includes.message')
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Images</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td class="text-center">{{$loop->index+1}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->product_price}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td><img src="{{ asset('uploads/products/'.$product->image) }}" width="100px" alt="Images"></td>
                                            <td>{{($product->status == 1)?'Published' :'Unpublished'}}</td>
                                            <td class="text-center">
                                                <div class="btn-group-vertical">
                                                    <a href="{{ route('product.multiple.image',['id' => $product->id]) }}" title="Upload Multiple Image" class="btn btn-info btn-sm"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                                    @if($product->status == 1)
                                                        <a href="{{ route('unpublished.product',['id' => $product->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-toggle-off"></i></a>
                                                    @else
                                                        <a href="{{ route('published.product',['id' => $product->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                                    @endif
                                                    <a href="{{ route('product.edit',['id' => $product->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a href="{{route('product.destroy',['id' => $product->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
    	        </div>
    	    </div>
        </div>
    </div>
@endsection
