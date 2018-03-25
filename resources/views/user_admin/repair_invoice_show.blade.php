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
                        <span id="processing"> </span>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div class="container-fluid invoice-container">
                            <div class="row">
                                <div class="col-sm-12">

                                    <table class="table" style="margin: 0">
                                        <tr>
                                            <td style="border-top: none;">
                                                <h3>{{ Helpers::get_option('company_name') }}</h3>
                                                <p>Shop : {{ ucwords($invoice->shop->name) }} <br />
                                                    Received by: {{ $invoice->user->get_fullname() }}</p>
                                            </td>

                                            <td  style="border-top: none;">
                                                <div class="text-right">
                                                    <h4>Invoice #{{ $invoice->invoice_id }}</h4>
                                                    <strong>Date:</strong>
              <span class="small-text">
                {{ $invoice->created_at->format('jS M Y') }} <br />
              </span>

                                                    <strong>Delivery Date:</strong>
              <span class="small-text">
                {{ $invoice->delivery_date->format('jS M Y') }} <br>
              </span>

                                                    <select name="status">
                                                        <option value="waiting" {{ $invoice->status== 'waiting'? 'selected' : '' }}> Waiting for repair </option>
                                                        <option value="in_process" {{ $invoice->status== 'in_process'? 'selected' : '' }}> Repair in process </option>
                                                        <option value="completed" {{ $invoice->status== 'completed'? 'selected' : '' }}> Repair completed </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>

                                </div>


                            </div>

                            <hr style="margin: 5px 0;">


                            <div class="row">
                                <div class="col-sm-12">

                                    <table class="table"  style="margin: 0">
                                        <tr>
                                            <td style="border-top: none;">
                                            <strong>Pay To:</strong>
                                            <address class="small-text">
                                                {{ $invoice->shop->name }} <br />
                                                {!! $invoice->address != ''? nl2br($invoice->address).'<br />' : '' !!}
                                                Contact : demo345 <br />
                                                E-mail : {{ $invoice->shop->email }}
                                            </address>
                                            </td>

                                            <td style="border-top: none; text-align: right">
                                                <strong>Invoiced To:</strong>
                                                <address class="small-text">
                                                    {{ $invoice->customer_name }}<br />
                                                    Contact : {{ $invoice->customer_phone }}<br />
                                                    {!! nl2br($invoice->customer_address) !!}<br />
                                                </address>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>

                            <br />

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Items</strong></h3>
                                        </div>
                                        <div class="panel-body">

                                            <table class="table"  style="margin: 0">
                                                <tr>
                                                    <td>Product</td>
                                                    <td>Engineer Notes</td>
                                                    <td>Qty</td>
                                                    <td>Item Price</td>
                                                    <td>Subtotal</td>
                                                </tr>

                                                @foreach($invoice->items as $item)

                                                    <tr>
                                                        <td> {{ $item->product->product_name }} </td>
                                                        <td> <input type="text" class="engineer_notes" data-id="{{ $item->id }}" value="{{ $item->engineer_note }}" /> </td>
                                                        <td> {{ $item->qty }} </td>
                                                        <td>{{ $item->unit_price }}</td>
                                                        <td>{{ $item->unit_price_total }}</td>
                                                    </tr>

                                                @endforeach

                                                <tr>
                                                    <td class="total-row text-right" colspan="4"><strong>Total</strong></td>
                                                    <td class="total-row">{{ $invoice->total_price }}</td>
                                                </tr>

                                            </table>

                                        </div>
                                    </div>


                                </div>
                            </div>

                            <p><b>Special Note:</b> {{ $invoice->special_note }}</p>

                            <div class="pull-right btn-group btn-group-sm hidden-print">
                                <a href="{{ route('print_repair_invoice', $invoice->id) }}" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Print</a>
                                <a href="{{ route('pdf_repair_invoice', $invoice->id) }}" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Download</a>
                            </div>
                        </div>




                    </div><!-- /.box-body -->


                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

@endsection

@section('page-js')
    <script>
        $('select[name="status"]').change(function(){
            var status = $(this).val();
            var cSelector = $(this);
            var repair_invoice_id = '{{ $invoice->id }}';
            $('span#processing').html('<i class="fa fa-spinner fa-spin"></i>').fadeIn(300);


            $.ajax({
                type : 'POST',
                url : '{{ route('change_repair_invoice_status') }}',
                data : { repair_invoice_id : repair_invoice_id, status : status, _token : '{{ csrf_token()  }}'},
                success : function(data){
                    if(data.status == 1){
                        $('span#processing').html('').fadeOut(300).delay(10000);
                    }else {
                        alert('Something went wrong, please try again');
                    }
                }
            });
        });

        $('body').on('change keyup', '.engineer_notes', function(){
            var engineer_note = $(this).val();
            var item_id = $(this).attr('data-id');

            $('span#processing').html('<i class="fa fa-spinner fa-spin"></i>').fadeIn(300);
            $.ajax({
                type : 'POST',
                url : '{{ route('save_engineer_note_in_item') }}',
                data : { engineer_note : engineer_note, item_id : item_id, _token : '{{ csrf_token()  }}'},
                success : function(data){
                    if(data.status == 1){
                        $('span#processing').html('').fadeOut(300).delay(10000);
                    }
                }
            });

        })


    </script>
@endsection