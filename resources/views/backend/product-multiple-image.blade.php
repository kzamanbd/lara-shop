@extends('backend.layouts.app')
@section('title','Product Multiple Image Upload')

@section('content')
    <div class="products">
        <section class="content-header">
          <h1>
            Product
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Multiple Image Upload</li>
          </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="card-title">Multiple Image Upload</h4>
                        </div>
                        <div class="box-body">
                            <div class="card-title">
                                <h3 class="text-center">Multiple Image Upload For {{$product->name}}</h3>
                            </div>
                            <hr>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="nav flex-column">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <img src="{{ asset('uploads/products/'.$product->product_image) }}" width="150">
                            <hr>
                            <form action="{{ route('product.multiple.image.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="form-group">
                                    <label for="file-input" class=" form-control-label">Product Image</label>
                                    <input type="file" name="product_image[]" id="file-input" class="form-control" multiple>
                                </div>
                                <div>
                                    <button id="add-button" type="submit" class="btn btn-success">
                                        <span id="add-button-amount">Upload Images</span>
                                        <span id="add-button-sending" style="display:none;">Uploading…</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
