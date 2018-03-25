@extends('user_admin.layout')
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
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Shop Name</th>
                                <th>Plan</th>
                                <th>Expiration</th>
                                <th>Status</th>
                            </tr>

                            @foreach($shops as $shop)
                                <tr>
                                    <td>{{ $shop->id }}</td>
                                    <td>
                                        <a href="{{ route('user_shop_view', $shop->id) }}"> <strong>{{ $shop->name }}</strong></a>
                                    </td>
                                    <td> {{ $shop->plan }}</td>
                                    <td>
                                        @if($shop->onSubscription())
                                            <p class="label label-success"> In Subscription : </p>
                                        @elseif($shop->onTrial() )
                                            <p class="label label-danger">In Trial :</p>
                                        @else
                                            <p class="label label-danger">Out of date :</p>
                                        @endif
                                        {{ $shop->hasExpire() }}
                                    </td>
                                    <td>{!! $shop->statusText() !!}</td>
                                </tr>
                            @endforeach


                        </table>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->



            </div> <!-- /.col -->
        </div>
        <!-- /.row -->


    </section><!-- /.content -->


@endsection