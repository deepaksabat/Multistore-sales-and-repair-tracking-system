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

                        {!! Form::open(['files' => 'true', 'class' => 'form-horizontal' ]) !!}
                        <div class="form-group {{ $errors->has('message_to')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Select User</label>
                            <div class="col-sm-9">
                                <select name="message_to" class="select2 form-control">
                                    <option value=""> Message To </option>
                                    <option value="admin"> {{ Helpers::get_option('company_name') }} Admin </option>
                                    @if($users->count() > 0)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"> {{ $user->get_fullname() }} </option>
                                        @endforeach
                                    @endif
                                </select>
                                {!! $errors->has('message_to')? '<p class="help-block"> '.$errors->first('message_to').' </p>':'' !!}
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('subject')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Subject *</label>
                            <div class="col-sm-9">
                                <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" />
                                {!! $errors->has('subject')? '<p class="help-block"> '.$errors->first('subject').' </p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('message')? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Message</label>
                            <div class="col-sm-9">
                                <textarea name="message" id="message" class="form-control" rows="3">{{ old('message') }}</textarea>
                                {!! $errors->has('message')? '<p class="help-block"> '.$errors->first('message').' </p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                        {{--                                @if($lUser->isShopAdmin())
                                                            {!! Form::hidden('from_shop_id', $lShop->id) !!}
                                                        @endif--}}
                                <button type="submit" class="btn btn-info"><i class="fa fa-send-o"></i> Send</button>
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