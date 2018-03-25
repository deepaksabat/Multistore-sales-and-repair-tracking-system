<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/invoice.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print()">




<div class="container-fluid invoice-container">


  <div class="row">
    <div class="col-sm-12">


      <table class="table" style="margin: 0;">
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

            </div>
          </td>
        </tr>

      </table>

    </div>


  </div>

  <hr style="margin: 5px 0;" />


  <div class="row">
    <div class="col-sm-12">

      <table class="table" style="margin: 0;">
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

          <td style="border-top: none;">
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

        <table class="table">
          <tr>
            <td>Product</td>
            <td>Qty</td>
            <td>Item Price</td>
            <td>Subtotal</td>
          </tr>

          @foreach($invoice->items as $item)
            <tr>
              <td> {{ $item->product->product_name }} </td>
              <td> {{ $item->qty }} </td>
              <td>{{ $item->unit_price }}</td>
              <td>{{ $item->unit_price_total }}</td>
            </tr>
          @endforeach

          <tr>
            <td class="total-row text-right" colspan="3"><strong>Total</strong></td>
            <td class="total-row">{{ $invoice->total_price }}</td>
          </tr>

        </table>

    </div>
  </div>


    </div>
  </div>

  <p><strong>Note:</strong> {{ Helpers::get_option('invoice_footer_note') }}</p>


</div>


</body>
</html>
