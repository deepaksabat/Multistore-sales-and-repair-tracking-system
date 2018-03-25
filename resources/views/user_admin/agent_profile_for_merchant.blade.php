@extends('user_admin.layout')
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
                <div class="col-md-3">
                    @include('user_admin.agent_profile_left')
                </div><!-- /.col -->
                <div class="col-md-9">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">



                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $agent->get_fullname() }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{ $agent->user_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $agent->email }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No</th>
                                    <td>{{ $agent->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $agent->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ nl2br($agent->address) }}</td>
                                </tr>

                                <tr>
                                    <th>Referral ID</th>
                                    <td>{{ $agent->referral_id }}</td>
                                </tr>
                                <tr>
                                    <th>Joining Date</th>
                                    <td>
                                        {{ $lShop->agent_single($agent->id)->pivot->created_at->format('F d, Y') }}
                                    </td>
                                </tr>
                            </table>




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