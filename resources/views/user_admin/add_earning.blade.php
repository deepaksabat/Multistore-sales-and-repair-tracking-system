@extends('user_admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

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
            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            {!! Form::open(['route' => ['user_add_earning', $shop->id], 'files' => 'true', 'class' => 'form-horizontal' ]) !!}

                            <div class="form-group {{ $errors->has('user_id')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Select User</label>
                                <div class="col-sm-9">

                                    <select name="user_id" class="select2 form-control">
                                        <option value=""> Select User </option>

                                        @foreach($shop->agents as $agent)
                                            <option value="{{ $agent->id }}"> {{ $agent->get_fullname() .' (refID = '.$agent->referral_id.' )' }} </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->has('user_id')? '<p class="help-block"> '.$errors->first('user_id').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('amount')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Amount *</label>
                                <div class="col-sm-9">
                                    <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" />
                                    {!! $errors->has('amount')? '<p class="help-block"> '.$errors->first('amount').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('against_invoice')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Against Invoice No. *</label>
                                <div class="col-sm-9">
                                    <input type="text" name="against_invoice" id="against_invoice" class="form-control" value="{{ old('against_invoice') }}" />
                                    {!! $errors->has('against_invoice')? '<p class="help-block"> '.$errors->first('against_invoice').' </p>':'' !!}
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('product_list')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Product List *</label>
                                <div class="col-sm-9">
                                    <textarea name="product_list" id="product_list" class="form-control" rows="3">{{ old('product_list') }}</textarea>
                                    <p class="help-block">Product hints that you sold and against make this earning to agent</p>
                                    {!! $errors->has('product_list')? '<p class="help-block"> '.$errors->first('product_list').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('purchaser_name')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Purchaser Name *</label>
                                <div class="col-sm-9">
                                    <input type="text" name="purchaser_name" id="purchaser_name" class="form-control" value="{{ old('purchaser_name') }}" />
                                    {!! $errors->has('purchaser_name')? '<p class="help-block"> '.$errors->first('purchaser_name').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('profile_photo')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Invoice Photo</label>

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
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap-filestyle.min.js') }}"> </script>
    <script>

        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });

        $(":file").filestyle({buttonName: "btn-primary", buttonBefore: true});
    </script>
@endsection