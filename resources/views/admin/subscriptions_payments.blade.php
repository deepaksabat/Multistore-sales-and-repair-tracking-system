@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }} | @parent @stop

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

                        <table class="table table-hover table-striped">
                            <tr>
                                <th>Merchant</th>
                                <th>Transaction ID</th>
                                <th>Months</th>
                                <th>Status</th>
                                <th>Validity Info</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Time</th>
                            </tr>

                            @foreach($payments as $subscription)
                                <tr>
                                    <td>{{ $subscription->shop->name }}</td>
                                    <td>{{ $subscription->subscription_tran_id }}</td>
                                    <td>{{ $subscription->total_month }}</td>
                                    <td>
                                        @if($subscription->status == 'notPay')
                                            <p class="text-muted">Not Pay</p>
                                        @elseif($subscription->status == 'Approved')
                                            <p class="text-success">{{ $subscription->status }}</p>
                                        @else
                                            <p class="text-danger">{{ $subscription->status }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('M d, Y', strtotime($subscription->extend_from)) }} - <br />
                                        {{ date('M d, Y', strtotime($subscription->extend_to)) }}
                                    </td>
                                    <td>{{ $subscription->amount }}</td>
                                    <td>{{ $subscription->method }}</td>
                                    <td>{{ $subscription->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach


                        </table>

                        {{ $payments->render() }}

                    </div><!-- /.box-body -->


                </div><!-- /.box -->

            </div> <!-- /.col -->
        </div>
        <!-- /.row -->

    </section><!-- /.content -->

@endsection