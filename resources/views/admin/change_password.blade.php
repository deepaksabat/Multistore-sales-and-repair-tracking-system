@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop


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
            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            {!! Form::open(['class' => 'form-horizontal']) !!}

                                <div class="form-group {{ $errors->has('old_password')? 'has-error' : '' }}">
                                    <label class="col-sm-3 control-label" for="old_password">Old password *</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="old_password" id="old_password" class="form-control" value="" autocomplete="off" placeholder="Old password" />
                                        {!! $errors->has('old_password')? '<p class="help-block"> '.$errors->first('old_password').' </p>':'' !!}
                                    </div>
                                </div>

                            <div class="form-group {{ $errors->has('new_password')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label" for="new_password">New password *</label>
                                <div class="col-sm-9">
                                    <input type="password" name="new_password" id="new_password" class="form-control" value="" autocomplete="off" placeholder="New password" />
                                    {!! $errors->has('new_password')? '<p class="help-block"> '.$errors->first('new_password').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('new_password_confirmation')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label" for="new_password_confirmation">New password confirmation *</label>
                                <div class="col-sm-9">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" value="" autocomplete="off" placeholder="Old password confirmation" />
                                    {!! $errors->has('new_password_confirmation')? '<p class="help-block"> '.$errors->first('new_password_confirmation').' </p>':'' !!}
                                </div>
                            </div>


                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->







                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->

@endsection