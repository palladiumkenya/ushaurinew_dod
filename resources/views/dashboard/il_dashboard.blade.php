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
        </div>
        <div class="row">

        <div class="col">

            <div class="form-group">
                    <label for="daterange" class="col-form-label"><b>Select Date Range</b></label>
                    <input class="form-control" id="daterange" type="text" name="daterange" />
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
                                <a class="has-arrow" href="{{route('Reports-il-facilities')}}">
                                    <b>{{count($il_facilities)}}<br></b>
                                    Facilities
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body grey" id="ltfuApps">
                                <a class="has-arrow" href="{{route('Reports-il-partners')}}">
                                    <b>{{count($il_partners)}}<br></b>
                                    Partners
                                    </a>
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

    @endsection

@section('page-js')


<div id="highchart"></div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js">
    </script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/data.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/bullet.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script type="text/javascript">

$(function() {
            $('#daterange').daterangepicker({
                "minYear": 2017,
                "autoApply": true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                "startDate": "04/10/2017",
                "endDate": moment().format('MM/DD/YYYY'),
                "opens": "left"
            }, function(start, end, label) {});
        });

var Kenyaemr =  <?php echo json_encode($il_kenyaemr) ?>;
var ADT =  <?php echo json_encode($il_adt) ?>;
var Registration =  <?php echo json_encode($il_registration) ?>;
console.log(Kenyaemr);
        Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'IL Appointments by Source'
        },
        xAxis: {
            categories: ['KENYAEMR Appointments', 'ADT Appointments', 'Client Registration']
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
                data: [Kenyaemr, ADT, Registration]
            }
        ],

    });

    var colors = Highcharts.getOptions().colors;
    </script>

@endsection





                <!-- end of col -->
