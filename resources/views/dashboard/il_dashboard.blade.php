@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')


<div class="separator-breadcrumb border-top"></div>

    <div class="col-md-12">

    <form class="form-inline">
    <div class="row">
            <div class="col">
                <div class="form-group">

                <select class="form-control filter_partner  input-rounded input-sm select2" name="filter_partner"
                    id="">
                    <option value="">Please select Partner</option>

                    <option></option>
                </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <select class="form-control filter_county  input-rounded input-sm select2" name="filter_county"
                    id="">
                    <option value="">Please select County</option>

                    <option></option>
                </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <span class="filter_sub_county_wait" style="display: none;">Loading , Please Wait ...</span>
                <select class="form-control filter_sub_county input-rounded input-sm select2" name="filter_sub_county"
                    id="">
                    <option value="">Please Select Sub County : </option>
                </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <span class="filter_facility_wait" style="display: none;">Loading , Please Wait ...</span>

                <select class="form-control filter_facility input-rounded input-sm select2" name="filter_facility"
                    id="">
                    <option value="">Please select Facility : </option>
                </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                <button class="btn btn-default filter_highcharts_dashboard btn-round  btn-small btn-primary  "
                    type="button" name="filter_highcharts_dashboard" id="filter_highcharts_dashboard"> <i
                        class="fa fa-filter"></i>
                    Filter</button>
                    </div>
            </div>
            </div>

            </form>

    </div>
    <div class="separator-breadcrumb border-top"></div>


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
