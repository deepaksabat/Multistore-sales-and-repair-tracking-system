@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '': $pageTitle }} | @parent @stop

@section('page-css')

@stop

@section('main')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($pageTitle) ? '': $pageTitle }}
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

                    <table class="table table-striped" >
                        <tr>
                            <th>Product Name</th> <td> {{ $product->product_name }} </td>
                        </tr>
                        <tr>
                            <th>Model</th> <td> {{ $product->product_model }} </td>
                        </tr>
                        <tr>
                            <th>Brand</th> <td> {{ $product->brand->brand_name }} </td>
                        </tr>
                        <tr>
                            <th>Category</th> <td> {{ $product->category->category_name }} </td>
                        </tr>
                        <tr>
                            <th>Unite Price</th> <td> {{ $product->unite_price }} </td>
                        </tr>

                        @if($product->attributes->count() > 0)
                            @foreach($product->attributes as $attribute)
                                <tr>
                                    <th>{{ $attribute->attribute_name }}</th> <td> {!! nl2br($attribute->attribute_value) !!} </td>
                                </tr>
                            @endforeach
                        @endif

                        <tr>
                            <th>Description</th> <td> {!! nl2br($product->description) !!} </td>
                        </tr>
                        <tr>
                            <th>Time</th> <td> {!! '<span title="'.$product->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$product->created_at->diffForHumans().' </span>' !!} </td>
                        </tr>

                        <tr>
                            <th>Added By</th> <td> {{ $product->user->get_fullname() }} </td>
                        </tr>

                    </table>

                </div><!-- /.box-body -->


            </div><!-- /.box -->



        </div> <!-- /.col -->
    </div>
    <!-- /.row -->


</section><!-- /.content -->


@endsection



@section('page-js')

@endsection
