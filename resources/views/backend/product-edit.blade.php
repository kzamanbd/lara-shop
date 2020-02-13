@extends('backend.layouts.app')
@section('title', 'Product Edit')

@section('content')
    <div class="order-manage">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Product Edit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Edit</li>
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
                                <h3>Product Edit Form</h3>
                            </div>
                            <div class="card-body">
                                @include('includes.error')

                                <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-group">
                                        <label class="control-label mb-3">Product Name:</label>
                                        <input name="name" type="text" class="form-control" placeholder="Enter Product Name" value="{{$product->name}}">
                                    </div>

                                    <div class="form-group">
                                        <select name="category_id" class="standardSelect form-control" tabindex="1">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{($product->category_id == $category->id)?"selected" : ""}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Product Price:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                                    <input name="product_price" type="text" class="form-control" placeholder="Enter Product Price" value="{{$product->product_price}}">
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Sale Price:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                                    <input name="sale_price" type="text" class="form-control" placeholder="Enter Sale Price" value="{{$product->sale_price}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Product Quantity:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-plus-square-o"></i></div>
                                                    <input name="quantity" type="text" class="form-control" placeholder="Enter Product Size" value="{{$product->quantity}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Product Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                    <input name="product_color" type="text" class="form-control" placeholder="Enter Product Color" value="{{$product->product_color}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Alert Quantity:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                    <input name="alert_quantity" type="text" class="form-control" placeholder="Enter Product Color" value="{{$product->alert_quantity}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description:</label>
                                        <textarea name="description" id="description" rows="6" class="form-control" placeholder="Description">{{$product->description}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <img src="{{ asset('uploads/products/'.$product->image) }}" id="priview" width="100px" alt="image">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Publication Status:</label>
                                        <input type="radio" name="status" value="1" {{$product->status == 1?'checked':''}}>Published
                                        <input type="radio" name="status" value="0" {{$product->status == 1?'':'checked'}}>Unpublished
                                    </div>
                                    <div class="form-group">
                                        <button id="add-button" type="submit" class="btn btn-success">
                                            <span id="add-button-amount">Update Product</span>
                                            <span id="add-product-sending" style="display:none;">Sending…</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

