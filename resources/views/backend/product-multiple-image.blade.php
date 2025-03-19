@extends('components.layouts.app', ['title' => 'Products'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Multiple Image Upload</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center">Multiple Image Upload For {{ $product->name }}</h3>
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
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="file-input" class=" form-label">Product Image</label>
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
@endsection
