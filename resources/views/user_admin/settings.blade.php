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

                        {!! Form::open(['files' => 'true', 'class' => 'form-horizontal' ]) !!}


                        <div class="form-group {{ $errors->has('shop_address')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Shop Address *</label>
                            <div class="col-sm-9">
                                <textarea name="shop_address" id="shop_address" class="form-control" rows="3">{{ $shop->address }}</textarea>
                                {!! $errors->has('shop_address')? '<p class="help-block"> '.$errors->first('shop_address').' </p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('bank_details')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Bank Details *</label>

                            <div class="col-sm-9">
                                <textarea name="bank_details" id="message" class="form-control" rows="4">{{ $shop->bank_details }}</textarea>
                                {!! $errors->has('bank_details')? '<p class="help-block"> '.$errors->first('bank_details').' </p>':'' !!}
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Email *</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" id="email" class="form-control" value="{{ $shop->email }}" />
                                {!! $errors->has('email')? '<p class="help-block"> '.$errors->first('email').' </p>':'' !!}
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('bank_details')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Logo</label>

                            <div class="col-sm-9">
                                <input type="file" id="photo" name="profile_photo" class="filestyle" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
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

@section('page-js')

    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap-filestyle.min.js') }}"> </script>
    <script>
        $(":file").filestyle({buttonName: "btn-primary", buttonBefore: true});
    </script>
@endsection
