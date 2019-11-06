@extends('backend.layouts.app')
@section('title','Settings')

@section('content')
    <div class="products">
        <section class="content-header">
          <h1>
            Settings
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings Option</li>
          </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="card-title">Settings Option</h4>
                        </div>
                        <div class="box-body">
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
                                    <input type="file" name="site_logo" class="form-control">
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
