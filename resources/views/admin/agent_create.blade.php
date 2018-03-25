@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }} | @parent @stop

@section('page-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}">
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
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    {!! Form::open(['class' => 'form-horizontal']) !!}

                    <div class="form-group {{ $errors->has('shop')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Shop *</label>

                        <div class="col-sm-7">
                            <select class="select2 form-control" name="shop">
                                <option value="">Select Shop</option>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->has('shop')? '<p class="help-block"> '.$errors->first('shop').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">First Name</label>
                        <div class="col-sm-7">
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First name">
                        {!! $errors->has('first_name')? '<p class="help-block"> '.$errors->first('first_name').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Last Name</label>
                        <div class="col-sm-7">
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" />
                        {!! $errors->has('last_name')? '<p class="help-block"> '.$errors->first('last_name').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('mobile_number')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Mobile Number</label>
                        <div class="col-sm-7">
                            <input type="number" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" placeholder="Mobile Number">
                            {!! $errors->has('mobile_number')? '<p class="help-block"> '.$errors->first('mobile_number').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('user_type')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Type</label>
                        <div class="col-sm-7">
                            <label><input type="radio" name="user_type" value="shop_admin" /> Shop Admin</label>
                            <label> <input type="radio" name="user_type" value="user" /> Shop Employee</label>

                            {!! $errors->has('user_type')? '<p class="help-block"> '.$errors->first('user_type').' </p>':'' !!}
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <legend>Login Credential</legend>
                    </div>

                    <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Email</label>
                        <div class="col-sm-7">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                            {!! $errors->has('email')? '<p class="help-block"> '.$errors->first('email').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Password</label>
                        <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        {!! $errors->has('password')? '<p class="help-block"> '.$errors->first('password').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Confirm Password</label>
                        <div class="col-sm-7">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        {!! $errors->has('password_confirmation')? '<p class="help-block"> '.$errors->first('password_confirmation').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Staff</button>
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