@extends('backend.layouts.app')
@section('title','Products Manage')

@section('content')
    <div class="products">
        <section class="content-header">
          <h1>
            New Product
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Product</li>
          </ol>
        </section>

    	<div class="content">
    		<div class="row">
    	        <div class="col-md-12">
    	            <div class="box box-info">
                        <div class="box-header">
                            <h3>New Product
                            <a href="{{route('manage.products')}}" class="btn btn-primary pull-right">Back</a></h3>
                        </div>
                        <div class="box-body">
                            @include('includes.error')
                            @include('includes.message')
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group has-success">
                                    <label class="control-label mb-3">Product Name:</label>
                                    <input name="name" type="text" class="form-control" placeholder="Enter Product Name" value="{{old('name')}}">
                                </div>

                                <div class="form-group has-success">
                                    <select name="category_id" data-placeholder="Choose Product Category..." class="form-control" tabindex="1">
                                        <option value="" label="-- Select One --"></option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Product Price:</label>
                                            <input name="product_price" type="text" class="form-control" placeholder="Enter Product Price" value="{{old('product_price')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Sale Price:</label>
                                            <input name="sale_price" type="text" class="form-control" placeholder="Enter Sale Price" value="{{old('sale_price')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Product Quantity:</label>
                                            <input name="quantity" type="text" class="form-control" placeholder="Enter Product Size" value="{{old('quantity')}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Product Color:</label>
                                            <input name="product_color" type="text" class="form-control" placeholder="Enter Product Color" value="{{old('product_color')}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Alert Quantity:</label>
                                            <input name="alert_quantity" type="text" class="form-control" placeholder="Enter Product Color" value="{{old('alert_quantity')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-success">
                                    <label class="control-label mb-1">Description:</label>
                                    <textarea name="product_description" id="product_description" rows="6" class="form-control" placeholder="Description">{{old('product_description')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="file-input" class=" form-control-label">Product image</label>
                                    <input type="file" id="file-input" name="product_image" class="form-control-file">
                                </div>

                                <div class="form-group has-success">
                                    <label class="control-label mb-1">Publication Status:</label>
                                    <input type="radio" name="status" value="1" checked>Published
                                    <input type="radio" name="status" value="0">Unpublished
                                </div>

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
    	        </div>
    	    </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('product_description');
    </script>
@endpush
