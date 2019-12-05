@extends('backend.layouts.app')
@section('title', 'Product Edit')
@push('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/trumbowyg/trumbowyg.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/select2.css') }}">
@endpush
@section('content')
    <div class="order-manage">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product Edit
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Edit</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    		<div class="row">
    	        <div class="col-md-12">
    	            <div class="box box-info">
                        <div class="box-header">
                            <h3>Product Edit Form</h3>
                        </div>
                        <div class="box-body">
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
                                    <label for="file-input" class=" form-control-label">Product image:</label><br>
                                    <img src="{{ asset('uploads/products/'.$product->image) }}" id="privie w" width="100px" alt="image">
                                    <input type="file" id="file -input" name="image" class="form-control">
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
        </section>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('backend/js/trumbowyg/trumbowyg.js') }}"></script>
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#description').trumbowyg();
            $('#category_id').select2({
                placeholder: 'Choose Product Category...'
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#priview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file-input").change(function() {
                readURL(this);
            });
        });
    </script>
@endpush
