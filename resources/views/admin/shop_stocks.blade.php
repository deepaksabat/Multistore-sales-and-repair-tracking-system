@extends('admin.layout')
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
                <div class="col-md-3">
                    @include('admin.shop_left')
                </div><!-- /.col -->
                <div class="col-md-9">


                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <table class="table table-bordered table-striped" id="jDataTable">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>In</th>
                                    <th>Total Product</th>
                                    <th>Unite Price</th>
                                    <th>Time</th>
                                </tr>
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
            ajax: '{{ route('shop_all_stocks_data', $shop->id) }}'
        });
    </script>
@endsection