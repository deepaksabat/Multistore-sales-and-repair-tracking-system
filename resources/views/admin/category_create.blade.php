@extends('admin.layout')
@section('title') {{ $pageTitle ? $pageTitle : '' }} | @parent @stop


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

                    <div class="form-group {{ $errors->has('category_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Name *</label>

                        <div class="col-sm-7">
                            <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" placeholder="Category Name">
                            {!! $errors->has('category_name')? '<p class="help-block"> '.$errors->first('category_name').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Category</button>
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