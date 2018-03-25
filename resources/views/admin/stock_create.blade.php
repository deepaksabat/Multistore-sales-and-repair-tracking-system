@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '': $pageTitle }} | @parent @stop

@section('page-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}">
@endsection


@section('main')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($pageTitle) ? '': $pageTitle }}
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

                    <div class="form-group {{ $errors->has('product')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Product *</label>

                        <div class="col-sm-7">
                            <select class="select2 form-control" name="product">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->has('product')? '<p class="help-block"> '.$errors->first('product').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('unite_price')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Unite Price *</label>

                        <div class="col-sm-7">
                            <input type="text" name="unite_price" class="form-control" value="{{ old('unite_price') }}" placeholder="Product Name">
                            {!! $errors->has('unite_price')? '<p class="help-block"> '.$errors->first('unite_price').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('total_product')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Total Product </label>

                        <div class="col-sm-7">
                            <input type="text" name="total_product" class="form-control" value="{{ old('total_product') }}" placeholder="Product Model">
                            {!! $errors->has('total_product')? '<p class="help-block"> '.$errors->first('total_product').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Stock</button>
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
        });
    </script>
@endsection