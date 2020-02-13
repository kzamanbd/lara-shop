@extends('customer.layouts.app')
@section('title')
    Profile
@endsection

@section('content')
    <div class="content">
		<div class="row">
	        <div class="col-md-8 offset-md-2">
	            <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Customer Information</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Customer Information</h3>
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
                                @if (Session::get('status'))
                                    <div class="alert alert-success">
                                        {{Session::get('status')}}
                                    </div>
                                @endif
                                @if (App\CProfile::where('user_id',Auth::user()->id)->exists())
                                    @php
                                        $customer_info = App\CProfile::where('user_id', Auth::user()->id)->first();
                                    @endphp
                                    <form action="{{ route('update-profile') }}" method="POST">
                                        @csrf
                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">First Name *</label>
                                            <input name="first_name" type="text" class="form-control" placeholder="Enter First Name" value="{{$customer_info->first_name}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Last Name *</label>
                                            <input name="last_name" type="text" class="form-control" placeholder="Enter Last Name" value="{{$customer_info->last_name}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Address *</label>
                                            <input name="address" type="text" class="form-control" placeholder="Address" value="{{$customer_info->address}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Phone Number *</label>
                                            <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number" value="{{$customer_info->phone}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Zip Code *</label>
                                            <input name="zip_code" type="text" class="form-control" placeholder="Enter Zip Code" value="{{$customer_info->zip_code}}">
                                        </div>

                                        <div>
                                            <button id="add-button" type="submit" class="btn btn-lg btn-outline-success btn-block">
                                                <span id="add-button-amount">Update Information</span>
                                                <span id="add-button-sending" style="display:none;">Sending…</span>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('profile-save') }}" method="POST">
                                        @csrf
                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">First Name *</label>
                                            <input name="first_name" type="text" class="form-control" placeholder="Enter First Name" value="{{old('first_name')}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Last Name *</label>
                                            <input name="last_name" type="text" class="form-control" placeholder="Enter Last Name" value="{{old('last_name')}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Address *</label>
                                            <input name="address" type="text" class="form-control" placeholder="Address" value="{{old('address')}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Phone Number *</label>
                                            <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number" value="{{old('phone')}}">
                                        </div>

                                        <div class="form-group has-success">
                                            <label class="control-label mb-2">Zip Code *</label>
                                            <input name="zip_code" type="text" class="form-control" placeholder="Enter Zip Code" value="{{old('zip_code')}}">
                                        </div>

                                        <div>
                                            <button id="add-button" type="submit" class="btn btn-lg btn-outline-success btn-block">
                                                <span id="add-button-amount">Add Information</span>
                                                <span id="add-button-sending" style="display:none;">Sending…</span>
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
	        </div>
	    </div>
    </div>
@endsection