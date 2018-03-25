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

                            {!! Form::open(['route'=>'settings_update', 'class' => 'form-horizontal']) !!}

                            <div class="form-group {{ $errors->has('company_name')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label" for="company_name">Company Name*</label>
                                <div class="col-sm-9">
                                    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name')? old('company_name') : Helpers::get_option('company_name') }}" />
                                    {!! $errors->has('company_name')? '<p class="help-block"> '.$errors->first('company_name').' </p>':'' !!}
                                </div>
                            </div>


                                <div class="form-group {{ $errors->has('invoice_footer_note')? 'has-error' : '' }}">
                                    <label class="col-sm-3 control-label" for="invoice_footer_note">Invoice footer note*</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="invoice_footer_note" id="invoice_footer_note" class="form-control" value="{{ old('invoice_footer_note')? old('invoice_footer_note') : Helpers::get_option('invoice_footer_note') }}" />
                                        {!! $errors->has('invoice_footer_note')? '<p class="help-block"> '.$errors->first('invoice_footer_note').' </p>':'' !!}
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