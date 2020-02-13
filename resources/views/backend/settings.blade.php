@extends('backend.layouts.app')
@section('title','Settings')

@section('content')
    <div class="products">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                                <h4 class="card-title">Settings Option</h4>
                            </div>
                            <div class="card-body">
                                @include('includes.error')

                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$settings?$settings->id:''}}">
                                    <div class="form-group">
                                        <label for="file-input" class=" form-control-label">Email Address</label>
                                        <input type="email" name="email" value="{{$settings?$settings->email:''}}" class="form-control" placeholder="Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="file-input" class=" form-control-label">Phone Number</label>
                                        <input type="text" name="phone" value="{{$settings?$settings->phone:''}}" class="form-control" placeholder="Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="file-input" class=" form-control-label">Site Logo</label><br>
                                        @if($settings->site_logo)
                                            <img src="" id="image" alt="Site Logo">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="site_logo" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="file-input" class=" form-control-label">Address</label>
                                        <input type="text" name="address" value="{{$settings?$settings->address:''}}" class="form-control" placeholder="Address">
                                    </div>

                                    <div class="form-group">
                                        <label for="file-input" class=" form-control-label">About us</label>
                                        <textarea name="about_us" rows="4" class="form-control">{{$settings?$settings->about_us:''}}</textarea>
                                    </div>

                                    <div>
                                        <button id="add-button" type="submit" class="btn btn-outline-success">
                                            <span id="add-button-amount">Update</span>
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
