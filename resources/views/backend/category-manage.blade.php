@extends('components.layouts.app', ['title' => 'Categories'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card box-info">
                        <div class="card-header flex justify-between">
                            <h5 class="card-title">Categories</h5>
                            <a href="{{ route('category.create') }}" class="btn btn-success pull-right">Add Category</a>
                        </div>
                        <div class="card-body">
                            @if (Session::get('status'))
                                <div class="alert alert-success">
                                    {{ Session::get('status') }}
                                </div>
                            @endif
                            @include('includes.error')
                            <table class="tw-table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-success btn-sm">Published</a>
                                                    <a href="" class="btn btn-info btn-sm">Edit</a>
                                                    <a href="{{ route('category.destroy', $category->id) }}"
                                                        class="btn btn-danger btn-sm">
                                                        Delete
                                                    </a>
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
