@extends('backend.layouts.app')
@section('title','Categories Manage')

@section('content')
    <div class="category">
        <section class="content-header">
          <h1>
            Categoies
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Category</li>
          </ol>
        </section>

    	<div class="content">
    		<div class="row">
    	        <div class="col-md-12">
    	            <div class="box box-info">
                        <div class="box-header">
                            <h3 class="card-title">New Category
                                <button type="button" class="btn btn-success pull-right">Back</button>
                            </h3>
                        </div>
                        <div class="box-body">
                            @include('includes.error')
                            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label mb-2">Category Name:</label>
                                        <input name="name" type="text" class="form-control" placeholder="Enter Category Name" value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-2">Image:</label>
                                        <input name="image" type="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Publication Status:</label>
                                        <input type="radio" name="status" value="1" checked>Published
                                        <input type="radio" name="status" value="0">Unpublished
                                    </div>
                                </div>
                                <div class="modal-footer">
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