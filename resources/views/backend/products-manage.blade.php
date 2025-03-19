@extends('backend.layouts.app')
@section('title', 'Products Manage')

@section('content')
    <div class="products">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Products Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products Products</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3>Products Manage Table
                                    <a href="{{ route('products.create') }}" class="btn btn-primary pull-right">
                                        New Product
                                    </a>
                                </h3>
                            </div>
                            <div class="card-body">
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
                                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->product_price }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td><img src="{{ $product->image_url }}" width="100px" alt="Images">
                                                    </td>
                                                    <td>{{ $product->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group-vertical">
                                                            <a href="{{ route('products.image', $product->id) }}"
                                                                title="Upload Multiple Image" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-upload" aria-hidden="true"></i></a>
                                                            @if ($product->status == 1)
                                                                <a href="{{ route('unpublished.product', $product->id) }}"
                                                                    class="btn btn-success btn-sm"><i
                                                                        class="fa fa-toggle-off"></i></a>
                                                            @else
                                                                <a href="{{ route('published.product', $product->id) }}"
                                                                    class="btn btn-success btn-sm"><i
                                                                        class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                                            @endif
                                                            <a href="{{ route('products.edit', $product->id) }}"
                                                                class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"
                                                                    aria-hidden="true"></i></a>
                                                            <a href="{{ route('products.destroy', $product->id) }}"
                                                                class="btn btn-danger btn-sm"><i class="fa fa-trash-o"
                                                                    aria-hidden="true"></i></a>
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
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
