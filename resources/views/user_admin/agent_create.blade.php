@extends('user_admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

@section('page-css')
@endsection

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
                        <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['class' => 'form-horizontal']) !!}

                            <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">First Name *</label>

                                <div class="col-sm-7">
                                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First name">
                                    {!! $errors->has('first_name')? '<p class="help-block"> '.$errors->first('first_name').' </p>':'' !!}
                                </div>


                            </div>
                            <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
                                <label class="control-label  col-sm-3">Last Name *</label>
                                <div class="col-sm-7">
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last name" />
                                    {!! $errors->has('last_name')? '<p class="help-block"> '.$errors->first('last_name').' </p>':'' !!}
                                </div>
                            </div>


                        <div class="form-group {{ $errors->has('mobile_number')? 'has-error' : '' }}">
                            <label class="control-label  col-sm-3">Mobile Number</label>
                            <div class="col-sm-7">
                                <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" placeholder="Mobile number with country code">
                                <p class="text-info">International format with country code, all sms notification will go to this number</p>
                                {!! $errors->has('mobile_number')? '<p class="help-block"> '.$errors->first('mobile_number').' </p>':'' !!}
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <legend>Login Credential</legend>
                        </div>


                        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                                <label class="control-label  col-sm-3">Email *</label>
                                <div class="col-sm-7">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                                    {!! $errors->has('email')? '<p class="help-block"> '.$errors->first('email').' </p>':'' !!}
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                                <label class="control-label  col-sm-3">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    {!! $errors->has('password')? '<p class="help-block"> '.$errors->first('password').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation')? 'has-error' : '' }}">
                                <label class="control-label  col-sm-3">Confirm Password</label>
                                <div class="col-sm-7">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                    {!! $errors->has('password_confirmation')? '<p class="help-block"> '.$errors->first('password_confirmation').' </p>':'' !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-7 col-sm-offset-3">
                                <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Agent</button>
                                </div>
                            </div>

                        {!! Form::close() !!}





                    </div><!-- /.box-body -->


                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

@endsection

@section('page-js')


@endsection
