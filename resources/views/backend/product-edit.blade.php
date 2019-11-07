@extends('backend.layouts.app')
@section('title')
    Product Add
@endsection

@section('content')
    <div class="order-manage">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    		<div class="row">
    	        <div class="col-md-12">
    	            <div class="box box-info">
                        <div class="box-header">
                            <h3>Product Edit Form</h3>
                        </div>
                        <div class="box-body">
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

                            <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
								@csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="form-group has-success">
                                    <label class="control-label mb-3">Product Name:</label>
                                    <input name="name" type="text" class="form-control" placeholder="Enter Product Name" value="{{$product->name}}">
                                </div>

                                <div class="form-group has-success">
                                    <select name="category_id" data-placeholder="Choose Product Category..." class="standardSelect form-control" tabindex="1">
                                        <option value="" label="default"></option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{($product->category_id == $category->id)?"selected" : ""}}>{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Product Price:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                                <input name="product_price" type="text" class="form-control" placeholder="Enter Product Price" value="{{$product->product_price}}">
                                            </div>                                                
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Product Quantity:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-plus-square-o"></i></div>
                                                <input name="quantity" type="text" class="form-control" placeholder="Enter Product Size" value="{{$product->quantity}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Product Color:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                <input name="product_color" type="text" class="form-control" placeholder="Enter Product Color" value="{{$product->product_color}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label mb-2">Alert Quantity:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                <input name="alert_quantity" type="text" class="form-control" placeholder="Enter Product Color" value="{{$product->alert_quantity}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-success">
                                    <label class="control-label mb-1">Description:</label>
                                    <textarea name="description" id="description" rows="6" class="form-control" placeholder="Description">{{$product->description}}</textarea>
                                </div>

                                <div class="form-group">
                                     <label for="file-input" class=" form-control-label">Product image:</label>
                                    <input type="file" id="file-input" name="product_image" class="form-control-file">
                                </div>

                                <div class="form-group has-success">
                                    <label class="control-label mb-1">Publication Status:</label>
                                    @if ($product->status == 1 )
                                        <input type="radio" name="status" value="1" checked>Published
                                        <input type="radio" name="status" value="0">Unpublished
                                    @else
                                        <input type="radio" name="status" value="1">Published
                                        <input type="radio" name="status" value="0" checked>Unpublished
                                    @endif
                                        {{-- expr --}}
                                </div>
                                <div class="col-sm-4 offset-sm-4">
                                    <button id="add-button" type="submit" class="btn btn-lg btn-outline-success btn-block">
                                        <span id="add-button-amount">Update Product</span>
                                        <span id="add-product-sending" style="display:none;">Sending…</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
    	        </div>
    	    </div>
        </section>
    </div>
@endsection
@push('javascript')
    <script src="{{asset('public/backend/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script type="text/javascript">

        if (CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
            CKEDITOR.tools.enableHtml5Elements( document );
        CKEDITOR.config.height = 250;
        CKEDITOR.config.width = 'auto';
        var initSample = ( function() {
            var wysiwygareaAvailable = isWysiwygareaAvailable(),
                isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );
            return function() {
                var editorElement = CKEDITOR.document.getById( 'description' );
                if ( isBBCodeBuiltIn ) {
                    editorElement.setHtml(
                        'Hello world!'
                    );
                }
                if ( wysiwygareaAvailable ) {
                    CKEDITOR.replace( 'description' );
                } else {
                    editorElement.setAttribute( 'contenteditable', 'true' );
                    CKEDITOR.inline( 'editor' );
                }
            };

            function isWysiwygareaAvailable() {
                if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
                    return true;
                }

                return !!CKEDITOR.plugins.get( 'wysiwygarea' );
            }
        } )();
        initSample();
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    </script>
@endpush
