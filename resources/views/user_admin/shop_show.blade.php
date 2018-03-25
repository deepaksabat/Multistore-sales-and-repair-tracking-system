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
                    @include('user_admin.shop_left')
                </div><!-- /.col -->
                <div class="col-md-9">

                    @if(Auth::user()->isShopAdmin())
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="overview">

                                <!-- Small boxes (Stat box) -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-xs-6">
                                            <!-- small box -->
                                            <div class="small-box bg-aqua">
                                                <div class="inner">
                                                    <h3>{{ $lShop->totalSales() }}</h3>
                                                    <p>Total Sales</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>
                                            </div>
                                        </div><!-- ./col -->



                                        <div class="clearfix"></div>
                                        <h3>Sales graph for {{ date('Y') }}</h3>

                                        <div class="chart">
                                            <canvas id="lineChart" style="height:400px;"></canvas>
                                        </div>

                                    </div>


                                </div> <!-- ./row -->




                            </div><!-- /.tab-pane -->


                        </div><!-- /.tab-content -->
                    </div><!-- /.nav-tabs-custom -->
                    @endif <!-- /if logged in as Merchant -->


                    @if(Auth::user()->isUser())

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">


                            </div><!-- /.box-body -->

                        </div><!-- /.box -->
                    @endif


                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->

@endsection

@section('page-js')
    <script src="{{ asset('assets/admin/plugins/chartjs/Chart.min.js') }}"></script>
    <script>
        $(function () {
            var areaChartData = {
                labels: <?php echo $label ?>,
                datasets: [
                    {
                        label: "Digital Goods",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [{{ $amount }}]
                    }
                ]
            };

            var areaChartOptions = {
                ///Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,
                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - Whether the line is curved between points
                bezierCurve : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension : 0.4,
                //Boolean - Whether to show a dot for each point
                pointDot : true,
                //Number - Radius of each point dot in pixels
                pointDotRadius : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth : 2,
                //Boolean - Whether to fill the dataset with a colour
                datasetFill : true,
                //String - A legend template
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

            };

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas);
            var lineChartOptions = areaChartOptions;
            lineChartOptions.datasetFill = false;
            lineChart.Line(areaChartData, lineChartOptions);


        });
    </script>
@endsection