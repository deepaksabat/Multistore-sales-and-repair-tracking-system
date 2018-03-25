<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Invoice</title>

  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/invoice-pdf.css') }}">
</head>
<body>

  <div class="container-fluid invoice-container">

    <header class="clearfix">

      <div id="top-header"  class="clearfix">
        <div id="mainLogo">
          <h3 style="margin: 0; font-size: 15px;">{{ Helpers::get_option('company_name') }}</h3>

          <p style="font-size: 12px">Shop : {{ ucwords($invoice->shop->name) }} <br />
            Received by: {{ $invoice->user->get_fullname() }}</p>
          <div style="margin: 20px 0 0 0"></div>
        </div>
        <div id="invNo">
          <h4>Invoice #{{ $invoice->invoice_id }}</h4>

          <strong>Date:</strong>
              <span class="small-text">
                {{ $invoice->created_at->format('jS M Y') }} <br><br>
              </span>
        </div>
      </div>
      <div style="margin: 25px 0 0 0"></div>

      <hr />
      <div id="company" class="clearfix">
        <strong>Pay To:</strong>
        <address class="small-text">
          {{ $invoice->shop->name }} <br />
          {!! $invoice->address != ''? nl2br($invoice->address).'<br />' : '' !!}
          Contact : demo345 <br />
          E-mail : {{ $invoice->shop->email }}
        </address>
      </div>
      <div id="project">
        <strong>Invoiced To:</strong>
        <address class="small-text">
          {{ $invoice->customer_name }}<br />
          Contact : {{ $invoice->customer_phone }}<br />
          {!! nl2br($invoice->customer_address) !!}<br />
        </address>
      </div>
    </header>

    <br /><br /><br /><br />

    <main>

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




      <div id="notices">
        <div class="notice"><strong>Note:</strong> {{ Helpers::get_option('invoice_footer_note') }} </div>

      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal. generate time {{ date('F d, Y h:i a') }}
    </footer>

  </div>
</body>
</html>