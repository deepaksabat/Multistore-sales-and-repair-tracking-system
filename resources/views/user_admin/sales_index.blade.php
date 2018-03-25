@extends('user_admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

@section('page-css')
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
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
                        <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                        <a href="{{ route('user_new_sales') }}" class="btn btn-primary pull-right">New Sale</a>

                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-bordered table-striped" id="jDataTable" >
                            <thead>
                                <th>Shop</th>
                                <th>Sales by</th>
                                <th>Invoice ID</th>
                                <th>Sales Price</th>
                                <th>Customer Name</th>
                                <th>Sales Time</th>
                                <th>Product</th>
                                <th>#</th>
                            </thead>
                        </table>


                    </div><!-- /.box-body -->


                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

@endsection


@section('page-js')
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#jDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('shop_sales_index') }}'
        });
    </script>
@endsection