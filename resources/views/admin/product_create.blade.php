@extends('admin.layout')
@section('title') {{ $pageTitle ? $pageTitle : '' }} | @parent @stop

@section('page-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}">
@endsection


@section('main')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $pageTitle ? $pageTitle : '' }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Shops</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                    {!! Form::open(['class' => 'form-horizontal']) !!}

                    <div class="form-group {{ $errors->has('category')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Category *</label>

                        <div class="col-sm-7">
                            <select class="select2 form-control" name="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->has('category')? '<p class="help-block"> '.$errors->first('category').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('brand')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Brand *</label>

                        <div class="col-sm-7">
                            <select class="select2 form-control" name="brand">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>

                            {!! $errors->has('brand')? '<p class="help-block"> '.$errors->first('brand').' </p>':'' !!}
                        </div>
                    </div>



                    <div class="form-group {{ $errors->has('product_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Name *</label>

                        <div class="col-sm-7">
                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" placeholder="Product Name">
                            {!! $errors->has('product_name')? '<p class="help-block"> '.$errors->first('product_name').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('unite_price')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Unite Price *</label>

                        <div class="col-sm-7">
                            <input type="text" name="unite_price" class="form-control" value="{{ old('unite_price') }}" placeholder="Unite Price">
                            {!! $errors->has('unite_price')? '<p class="help-block"> '.$errors->first('unite_price').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('product_model')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Product Model </label>

                        <div class="col-sm-7">
                            <input type="text" name="product_model" class="form-control" value="{{ old('product_model') }}" placeholder="Product Model">
                            {!! $errors->has('product_model')? '<p class="help-block"> '.$errors->first('product_model').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('description')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Description </label>

                        <div class="col-sm-7">
                            <textarea name="description" class="form-control" rows="5"> {{ old('description') }} </textarea>
                            {!! $errors->has('description')? '<p class="help-block"> '.$errors->first('description').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <legend>Additional Attributes
                            <a href="javascript:;" class="btn btn-info btn-sm pull-right" id="addAttribute" style="margin-bottom: 5px;">Add Attribute</a>
                            <div class="clearfix"></div>
                        </legend>
                    </div>

                    <div id="attributeContainer">

                        @if(session('old_product_attribute'))
                            @for($i = 0; $i < count(session('old_product_attribute')['attribute_name']); $i++)

                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label class="control-label col-sm-4">Attribute Name </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="attribute_name[]" class="form-control" value="{{ session('old_product_attribute')['attribute_name'][$i] }}" placeholder="Attribute Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <label class="control-label col-sm-3">Attribute Value </label>
                                        <div class="col-sm-7">
                                            <input type="text" name="attribute_value[]" class="form-control" value="{{ session('old_product_attribute')['attribute_value'][$i] }}" placeholder="Attribute Value">
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="javascript:;" class="btn btn-danger attributeDelBtn"> <i class="fa fa-trash-o"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                        @else
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label class="control-label col-sm-4">Attribute Name </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="attribute_name[]" class="form-control"  placeholder="Attribute Name">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <label class="control-label col-sm-3">Attribute Value </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="attribute_value[]" class="form-control"  placeholder="Attribute Value">
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="javascript:;" class="btn btn-danger attributeDelBtn"> <i class="fa fa-trash-o"></i> </a>
                                    </div>
                                </div>
                            </div>

                        @endif


                    </div>






                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Product</button>
                        </div>
                    </div>

                    {!! Form::close() !!}






                </div><!-- /.box-body -->


            </div><!-- /.box -->



        </div> <!-- /.col -->
    </div>
    <!-- /.row -->


</section><!-- /.content -->


@endsection

@section('page-js')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $(".select2").select2();


            $('#addAttribute').click(function(){
                $.ajax({
                    type : 'GET',
                    url : '{{ route('add_product_attribute') }}',
                    success : function(data){
                        $('#attributeContainer').append(data);
                    }
                });
            });


        });

        $('body').on('click', 'a.attributeDelBtn', function(){
            $(this).closest('div.form-group').removeClass( "form-group" ).html('');
        });


    </script>
@endsection