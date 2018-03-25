<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sign in to {{ Helpers::get_option('company_name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/invoice.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>




<div class="container-fluid invoice-container">


  <div class="row">
    <div class="col-sm-7">

      <p><img src="https://clients.dhrubohost.com/images/dhrubohostlogo.png" title="Dhrubo Host" /></p>
      <h3>Invoice #1872</h3>

    </div>
    <div class="col-sm-5 text-center">

      <div class="invoice-status">
        <span class="paid">Paid</span>
      </div>


    </div>
  </div>

  <hr>


  <div class="row">
    <div class="col-sm-6 pull-sm-right text-right-sm">
      <strong>Pay To:</strong>
      <address class="small-text">
        Dhrubo Host <br />
        763/1 West Kazipara, Mirpur<br />
        Dhaka-1216, Bangladesh. <br />
        Contact : +8801795 470074 <br />
        E-mail : sales@dhrubohost.com
      </address>
    </div>
    <div class="col-sm-6">
      <strong>Invoiced To:</strong>
      <address class="small-text">
        MhCode.com<br />                        Md Hossain Shohel<br />
        183/D shajahan road, Mohammadpur, Dhaka, <br />
        Dhaka, Dhaka, 1207<br />
        Bangladesh
      </address>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <strong>Payment Method:</strong><br>
                    <span class="small-text">
                                                    EasyPayWay (Debit / Credit Card)
                                            </span>
      <br /><br />
    </div>
    <div class="col-sm-6 text-right-sm">
      <strong>Invoice Date:</strong><br>
                    <span class="small-text">
                        4th Dec 2015<br><br>
                    </span>
    </div>
  </div>

  <br />



  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><strong>Invoice Items</strong></h3>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-condensed">
          <thead>
          <tr>
            <td><strong>Description</strong></td>
            <td width="20%" class="text-center"><strong>Amount</strong></td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>Domain Renewal - mhcode.com - 1 Year/s (03/01/2016 - 02/01/2017)<br />
              + DNS Management<br />
              + Email Forwarding *</td>
            <td class="text-center">$10.00 USD</td>
          </tr>
          <tr>
            <td class="total-row text-right"><strong>Sub Total</strong></td>
            <td class="total-row text-center">$10.00 USD</td>
          </tr>
          <tr>
            <td class="total-row text-right"><strong>3.00% Transaction Fees</strong></td>
            <td class="total-row text-center">$0.30 USD</td>
          </tr>
          <tr>
            <td class="total-row text-right"><strong>Credit</strong></td>
            <td class="total-row text-center">$0.00 USD</td>
          </tr>
          <tr>
            <td class="total-row text-right"><strong>Total</strong></td>
            <td class="total-row text-center">$10.30 USD</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <p>* Indicates a taxed item.</p>

  <div class="transactions-container small-text">
    <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
        <tr>
          <td class="text-center"><strong>Transaction Date</strong></td>
          <td class="text-center"><strong>Gateway</strong></td>
          <td class="text-center"><strong>Transaction ID</strong></td>
          <td class="text-center"><strong>Amount</strong></td>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="text-center">4th Dec 2015</td>
          <td class="text-center">EasyPayWay (Debit / Credit Card)</td>
          <td class="text-center"></td>
          <td class="text-center">$10.30 USD</td>
        </tr>
        <tr>
          <td class="text-right" colspan="3"><strong>Balance</strong></td>
          <td class="text-center">$0.00 USD</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="pull-right btn-group btn-group-sm hidden-print">
    <a href="javascript:window.print()" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
    <a href="dl.php?type=i&amp;id=1872" class="btn btn-default"><i class="fa fa-download"></i> Download</a>
  </div>


</div>


</body>
</html>
