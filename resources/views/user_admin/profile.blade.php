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
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <td>{{ $lUser->get_fullname() }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $lUser->email }}</td>
                            </tr>

                            <tr>
                                <th>Mobile</th>
                                <td>{{ $lUser->mobile }}</td>
                            </tr>

                            @if($lUser->isShopAdmin())
                            <tr>
                                <th>Admin</th>
                                <td>{{ $lShop->name }}</td>
                            </tr>
                            @elseif($lUser->isUser())
                            <tr>
                                <th>Merchants</th>
                                <td>
                                    @foreach($lUser->joinedShops as $shop)
                                    {!! '<a href="' . route('user_shop_view', $shop->id) . '"> <strong>' . $shop->name . '</strong></a><br />' !!}
                                    @endforeach
                                </td>
                            </tr>

                            @endif

                            <tr>
                                <th></th>
                                <td><a href="{{ route('user_profile_edit') }}" class="btn btn-info"> <i class="fa fa-pencil"></i>  Edit</a> </td>
                            </tr>

                        </table>


                    </div><!-- /.box-body -->


                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

@endsection

@section('page-js')

@endsection