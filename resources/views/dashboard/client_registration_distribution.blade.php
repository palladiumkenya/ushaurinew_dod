@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')





<div id="highchart"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="row">
<div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                        <div id="entryPoint" class="col" style="height: 450px;margin-top:40px;"></div> <br />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>

    <script type="text/javascript">
        var mobileEntry =  <?php echo json_encode($client_entry_point_mobile) ?>;
        var ilEntry =  <?php echo json_encode($client_entry_point_il) ?>;
        var webEntry =  <?php echo json_encode($client_entry_point_web) ?>;
        Highcharts.chart('entryPoint', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Client Distribution by Registration Point'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Clients',
        colorByPoint: true,
        data: [{
            name: 'Mobile',
            y: mobileEntry
        }, {
            name: 'Web',
            y: webEntry
        }, {
            name: 'IL',
            y: ilEntry
        } ]
    }]
});
    </script>





                <!-- end of col -->

@endsection