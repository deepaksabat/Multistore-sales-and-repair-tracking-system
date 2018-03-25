@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }} | @parent @stop


@section('main')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($pageTitle) ? '' : $pageTitle }}
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
                    <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    {!! Form::open(['class' => 'form-horizontal']) !!}

                    <div class="form-group {{ $errors->has('shop_name')? 'has-error' : '' }}">
                        <label class="control-label  col-sm-3">Shop Name</label>

                        <div class="col-sm-7">
                        <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
                        {!! $errors->has('shop_name')? '<p class="help-block"> '.$errors->first('shop_name').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('shop_email')? 'has-error' : '' }}">
                        <label class="control-label  col-sm-3">Shop Email</label>
                        <div class="col-sm-7">

                            <input type="text" name="shop_email" class="form-control" value="{{ old('shop_email') }}">
                            {!! $errors->has('shop_email')? '<p class="help-block"> '.$errors->first('shop_email').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('shop_mobile_number')? 'has-error' : '' }}">
                        <label class="control-label  col-sm-3">Shop Mobile Number</label>
                        <div class="col-sm-7">

                        <input type="text" name="shop_mobile_number" class="form-control" value="{{ old('shop_mobile_number') }}">
                        {!! $errors->has('shop_mobile_number')? '<p class="help-block"> '.$errors->first('shop_mobile_number').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('shop_address')? 'has-error' : '' }}">
                        <label class="control-label  col-sm-3">Shop Address *</label>
                        <div class="col-sm-7">

                        <textarea name="shop_address" id="message" class="form-control" rows="4">{{ old('shop_address') }}</textarea>
                        {!! $errors->has('shop_address')? '<p class="help-block"> '.$errors->first('shop_address').' </p>':'' !!}
                        </div>
                    </div>








                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Shop</button>
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