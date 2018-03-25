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
                            <a href="{{ route('user_all_sales') }}" class="btn btn-primary pull-right">All Sales</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            {!! Form::open(['files' => 'true', 'class' => 'form-horizontal' ]) !!}

                            <div class="form-group {{ $errors->has('customer_name')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Customer Name *</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name') }}" />
                                    {!! $errors->has('customer_name')? '<p class="help-block"> '.$errors->first('customer_name').' </p>':'' !!}
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('customer_email')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Customer Email </label>
                                <div class="col-sm-7">
                                    <input type="text" name="customer_email" id="customer_email" class="form-control" value="{{ old('customer_email') }}" />
                                    {!! $errors->has('customer_email')? '<p class="help-block"> '.$errors->first('customer_email').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('customer_phone')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Customer Phone *</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="{{ old('customer_phone') }}" />
                                    {!! $errors->has('customer_phone')? '<p class="help-block"> '.$errors->first('customer_phone').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('customer_address')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Customer Address*</label>
                                <div class="col-sm-7">
                                    <textarea name="customer_address" id="customer_address" class="form-control" rows="3">{{ old('customer_address') }}</textarea>
                                    <p class="help-block">Address within 500 character, press enter will create new line</p>
                                    {!! $errors->has('customer_address')? '<p class="help-block"> '.$errors->first('customer_address').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <legend>Product Listed
                                    <a href="javascript:;" class="btn btn-info pull-right" id="addAttribute" style="margin-bottom: 5px;" data-toggle="modal" data-target="#addProductModal"><i class="fa fa-cart-plus"></i> Add Product</a>
                                    <div class="clearfix"></div>
                                </legend>
                            </div>


                            <div class="col-sm-12">
                                <div id="cartContent">

                                    @if(Cart::count() > 0)
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Item Price</th>
                                            <th>Subtotal</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach(Cart::content() as $row)

                                            <tr>
                                                <td>
                                                    <p><strong>{{ $row->name }}</strong></p>
                                                </td>
                                                <td> <input type="number" class="qty" min="1" value="{{ $row->qty }}" style="max-width: 100px;" /> </td>
                                                <td>{{ $row->price }}</td>
                                                <td>{{ $row->subtotal }}</td>
                                                <td>
                                                    <a href="javascript:;" class="btn btn-success updateProductBtn" data-id="{{ $row->rowid }}" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-refresh"></i> </a>
                                                    <a href="javascript:;" class="btn btn-danger removeProductBtn" data-id="{{ $row->rowid }}" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-trash-o"></i> </a>
                                                </td>
                                            </tr>

                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td> {{ Cart::total() }} </td>
                                            <td></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    @else
                                        <p>There have no product,</p>
                                    @endif

                                </div>


                            </div>




                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check-circle-o"></i> Submit</button>
                                </div>
                            </div>
                            </form>


                        </div><!-- /.box-body -->


                    </div><!-- /.box -->

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->





        <!-- Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Product</h4>
                    </div>
                    <div class="modal-body">
                        <p id="modalInfo"></p>
                        <div class="form-horizontal">

                            <div class="form-group {{ $errors->has('user_id')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Select Product</label>
                                <div class="col-sm-9">

                                    <select name="product_id" class="select2 form-control" style="width: 100%">
                                        <option value=""> Select Product </option>

                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}"> {{ $product->product_name }} </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->has('user_id')? '<p class="help-block"> '.$errors->first('user_id').' </p>':'' !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('product_qty')? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">Quantity *</label>
                                <div class="col-sm-9">
                                    <input type="number" name="product_qty" id="product_qty" class="form-control" min="1" value="1" placeholder="Product Quantity"/>
                                    {!! $errors->has('product_qty')? '<p class="help-block"> '.$errors->first('product_qty').' </p>':'' !!}
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" id="addModalProductBtn"><i class="fa fa-cart-plus"></i> Add Product</button>
                    </div>
                </div>
            </div>
        </div>



@endsection

@section('page-js')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap-filestyle.min.js') }}"> </script>
    <script>

        function get_cart_data()
        {
            $.ajax({
                type : 'GET',
                url : '{{ route('get_cart_content_ajax') }}',
                success : function(data_return){
                    $('#cartContent').html(data_return);
                }
            });
        }


        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();



            $('#addModalProductBtn').click(function(){
                var product_qty = $('input[name="product_qty"]').val();
                var product_id = $('select[name="product_id"]').val();

                if(product_id == '')
                {
                    $('#modalInfo').html('<span class="text-red">Please select product</span>');
                    return ;
                }
                if(product_qty == '')
                {
                    $('#modalInfo').html('<span class="text-red">Please enter quantity</span>');
                    return ;
                }

                $.ajax({
                    type : 'POST',
                    url : '{{ route('add_modal_product') }}',
                    data : { product_qty : product_qty, product_id : product_id, _token : '{{ csrf_token() }}' },
                    success : function(data){
                        if(data.status == 1)
                        {
                            $('#addProductModal').modal('hide');
                            get_cart_data()
                        }
                    }
                });
            });

        });


        $('body').on('click', '.removeProductBtn', function(){
            var selector = $(this);
            var rowID = selector.attr('data-id');
            $.ajax({
                type : 'POST',
                url : '{{ route('remove_cart_row_product') }}',
                data : { rowID : rowID, _token : '{{ csrf_token() }}' },
                success : function(data){
                    if(data.status == 1)
                    {
                        get_cart_data()
                    }
                }
            });
        });

        $('body').on('click', '.updateProductBtn', function(){
            var selector = $(this);
            var rowID = selector.attr('data-id');
            var qty = selector.closest('tr').find('.qty').val();

            $.ajax({
                type : 'POST',
                url : '{{ route('update_cart_row_product') }}',
                data : { rowID : rowID, qty : qty, _token : '{{ csrf_token() }}' },
                success : function(data){
                    if(data.status == 1)
                    {
                        get_cart_data()
                    }
                }
            });
        });




    </script>
@endsection