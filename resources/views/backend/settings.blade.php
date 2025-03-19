@extends('components.layouts.app', ['title' => 'Settings'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Settings</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.error')

                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $settings ? $settings->id : '' }}">
                                <div class="form-group">
                                    <label for="file-input" class=" form-label">Email Address</label>
                                    <input type="email" name="email" value="{{ $settings->email }}" class="form-control"
                                        placeholder="Phone Number">
                                </div>

                                <div class="form-group">
                                    <label for="file-input" class="form-label">Phone Number</label>
                                    <input type="text" name="phone" value="{{ $settings->phone }}" class="form-control"
                                        placeholder="Phone Number">
                                </div>

                                <div class="form-group">
                                    <label for="file-input" class="form-label">Site Logo</label><br>
                                    @if ($settings->site_logo)
                                        <img src="{{ $settings->site_logo }}" id="image" alt="Site Logo">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="site_logo" class="form-control"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file-input" class=" form-label">Address</label>
                                    <input type="text" name="address" value="{{ $settings->address }}"
                                        class="form-control" placeholder="Address">
                                </div>

                                <div class="form-group">
                                    <label for="file-input" class=" form-label">About us</label>
                                    <textarea name="about_us" rows="4" class="form-control">{{ $settings->about_us }}</textarea>
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
@endsection
