@extends('backend.layouts.app')
@section('title', 'Product Multiple Image Upload')

@section('content')
    <div class="products">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Product Edit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Multiple Image Upload</li>
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
                                <h4 class="card-title">Multiple Image Upload</h4>
                            </div>
                            <div class="card-body">
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
                                <img src="{{ $product->image_url }}" width="150">
                                <hr>
                                <form action="{{ route('product.multiple.image.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-group">
                                        <label for="file-input" class=" form-control-label">Product Image</label>
                                        <input type="file" name="image[]" id="file-input" class="form-control" multiple>
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
    </div>

@endsection
