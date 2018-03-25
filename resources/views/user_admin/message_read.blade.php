@extends('user_admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

@section('page-css')

@stop

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
                        <h3 class="box-title">{{ $message->subject }}</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                            </div><!-- /.btn-group -->
                            <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                            <div class="pull-right">

                                <p class="text-muted pull-left">{{ $message->is_read() }} | </p>
                                <p class="text-muted pull-left" title="{{ $message->created_at->format('F d,Y h:i A') }}" style="margin-left: 5px;">
                                    {{ $message->created_at->diffForHumans() }}
                                </p>

                            </div><!-- /.pull-right -->
                        </div>

                        <hr />
                        {!! nl2br($message->message) !!}


                        @if($message->replied->count() > 0)
                            @foreach($message->replied as $reply)
                                <hr />
                                <div class="">
                                    <p class="text-muted pull-left " title="{{ $reply->sender() }}" style="margin-left: 5px;">
                                        From : {{ $reply->sender() }}
                                    </p>
                                    <p class="text-muted pull-right" title="{{ $reply->created_at->format('F d,Y h:i A') }}" style="margin-left: 5px;">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </p>
                                </div><!-- /.pull-right -->
                                <div class="clearfix"></div>
                                {!! nl2br($reply->message) !!}
                            @endforeach
                        @endif

                        <div class="replyWrapper">
                            <hr />
                            {!! Form::open(['files' => 'true', 'class' => 'form-horizontal' ]) !!}
                            <div class="form-group {{ $errors->has('message')? 'has-error' : '' }}">
                                <div class="col-sm-12">
                                    <textarea name="message" id="message" class="form-control" rows="3">{{ old('message') }}</textarea>
                                    {!! $errors->has('message')? '<p class="help-block"> '.$errors->first('message').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-reply"></i> Reply</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>


                    </div><!-- /.box-body -->


                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

@endsection


@section('page-js')


@endsection