@extends('backend.layouts.app')
@section('title','Categories Manage')

@section('content')
    <div class="category">
        <section class="content-header">
          <h1>
            Manage Categoies
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Categoies</li>
          </ol>
        </section>

    	<div class="content">
    		<div class="row">
    	        <div class="col-md-12">
    	            <div class="box box-info">
                        <div class="box-header">
                            <h3 class="card-title">Categories Manage Table
                                <a href="{{route('category.create')}}" class="btn btn-success pull-right">Add Category</a>
                            </h3>
                        </div>
                        <div class="box-body">
                            @if (Session::get('status'))
                                <div class="alert alert-success">
                                    {{Session::get('status')}}
                                </div>
                            @endif
                            @include('includes.error')
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL No</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="text-center">{{$loop->index+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{($category->status == 1)?'Published' :'Unpublished'}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="" class="btn btn-success btn-sm">Published</a>
                                                <a href="" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{route('category.delete',['id' => $category->id])}}" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Data In this Table</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
    	        </div>
    	    </div>
        </div>
    </div>
@endsection
