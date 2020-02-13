@extends('backend.layouts.app')
@section('title','Categories Manage')

@section('content')
    <div class="category">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categoies</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">New Categoies</li>
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
                                <h3 class="card-title">New Category</h3>
                                <button type="button" class="btn btn-success pull-right">Back</button>
                            </div>
                            <div class="card-body">
                                @include('includes.error')
                                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Category Name:</label>
                                            <input name="name" type="text" class="form-control" placeholder="Enter Category Name" value="{{old('name')}}">
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" class="input-group-text btn" id="">Upload</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Publication Status:</label>
                                            <input type="radio" name="status" value="1" checked>Published
                                            <input type="radio" name="status" value="0">Unpublished
                                        </div>
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