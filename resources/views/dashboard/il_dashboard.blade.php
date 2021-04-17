@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')





<div id="highchart"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/high-contrast-light.js"></script>

    <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body grey" id="allApps">
                                    <b>{{$il_appointments}}<br></b>
                                    Total Appointments
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body grey" id="keptApps">
                                    <b>{{$il_future_apps}}<br></b>
                                    Future Appointments
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body grey" id="defaultedApps">
                                    <b>{{$messages_count}}<br></b>
                                    Messages Sent
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body grey" id="missedApps">
                                    <b>{{count($il_facilities)}}<br></b>
                                    Facilities
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body grey" id="ltfuApps">
                                    <b>{{count($il_partners)}}<br></b>
                                    Partners
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="card-body row">
                                <div id="container" class="col" style="height: 400px;margin-top:40px;"></div> <br />
                            </div>
                            <div class="card-body row">
                                <div id="trend" class="col" style="height: 450px;margin-top:40px;"></div>
                            </div>
                        </div>
                    </div>




    <script type="text/javascript">

var Kenyaemr =  <?php echo json_encode($il_kenyaemr) ?>;
var ADT =  <?php echo json_encode($il_adt) ?>;
        Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'IL Appointments by Source'
        },
        xAxis: {
            categories: ['KENYAEMR', 'ADT']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Appointments Count'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'gray'
                }
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Sum of all appointment categories: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
            }
        },
        series: [{
                name: 'Appointments',
                data: [Kenyaemr, ADT]
            }
        ],

    });

    var colors = Highcharts.getOptions().colors;
    </script>




</div>
</div>
                <!-- end of col -->

@endsection
