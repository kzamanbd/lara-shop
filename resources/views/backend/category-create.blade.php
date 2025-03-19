@extends('components.layouts.app', ['title' => 'New Category'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header flex justify-between">
                            <h5 class="card-title">New Category</h5>
                            <button type="button" class="btn btn-success pull-right">Back</button>
                        </div>
                        <div class="card-body">
                            @include('includes.error')
                            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label mb-2">Category Name:</label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Enter Category Name" value="{{ old('name') }}">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text btn"
                                                    id="">Upload</button>
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
@endsection
