@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')

<div class="col-md-12 mb-4">
<div class="row">



<div id="highchart"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/high-contrast-light.js"></script>

    <div id="container" name="container"></div>
    <script type="text/javascript">
        var singleMissed =  <?php echo json_encode($all_appointment_by_marital_single_missed) ?>;
        var singleDefaulted =  <?php echo json_encode($all_appointment_by_marital_single_defaulted) ?>;
        var singleLTFU =  <?php echo json_encode($all_appointment_by_marital_single_ltfu) ?>;

        var monogamousMissed =  <?php echo json_encode($all_appointment_by_marital_monogomous_missed) ?>;
        var monogamousDefaulted =  <?php echo json_encode($all_appointment_by_marital_monogomous_defaulted) ?>;
        var monogamousLTFU =  <?php echo json_encode($all_appointment_by_marital_monogomous_lftu) ?>;

        var divorcedMissed =  <?php echo json_encode($all_appointment_by_marital_divorced_missed) ?>;
        var divorcedDefaulted =  <?php echo json_encode($all_appointment_by_marital_divorced_defaulted) ?>;
        var divorcedLTFU =  <?php echo json_encode($all_appointment_by_marital_divorced_lftu) ?>;

        var widowedMissed =  <?php echo json_encode($all_appointment_by_marital_widowed_missed) ?>;
        var widowedDefaulted =  <?php echo json_encode($all_appointment_by_marital_widowed_defaulted) ?>;
        var widowedLTFU =  <?php echo json_encode($all_appointment_by_marital_widowed_lftu) ?>;

        var cohabitingMissed =  <?php echo json_encode($all_appointment_by_marital_cohabiting_missed) ?>;
        var cohabitingDefaulted =  <?php echo json_encode($all_appointment_by_marital_cohabiting_defaulted) ?>;
        var cohabitingLTFU =  <?php echo json_encode($all_appointment_by_marital_cohabiting_lftu) ?>;

        var unavailableMissed =  <?php echo json_encode($all_appointment_by_marital_unavailable_missed) ?>;
        var unavailableDefaulted =  <?php echo json_encode($all_appointment_by_marital_unavailable_defaulted) ?>;
        var unavailableLTFU =  <?php echo json_encode($all_appointment_by_marital_unavailable_lftu) ?>;

        var polygamousMissed =  <?php echo json_encode($all_appointment_by_marital_polygamous_missed) ?>;
        var polygamousDefaulted =  <?php echo json_encode($all_appointment_by_marital_polygamous_defaulted) ?>;
        var polygamousLTFU =  <?php echo json_encode($all_appointment_by_marital_polygamous_lftu) ?>;

        var notapplicableMissed =  <?php echo json_encode($all_appointment_by_marital_notapplicable_missed) ?>;
        var notapplicableDefaulted =  <?php echo json_encode($all_appointment_by_marital_notapplicable_defaulted) ?>;
        var notapplicableLTFU =  <?php echo json_encode($all_appointment_by_marital_notapplicable_lftu) ?>;

        Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Appointments by Marital Status'
        },
        xAxis: {
            categories: ['Single', 'Married Monogamous', 'Divorced', 'Widowed', 'Cohabiting', 'Unavailable', 'Married Polygamous', 'Not Applicable']
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
                name: 'Honoured Appointments',
                data: singleMissed
            }, {
                name: 'Active Defaulters',
                data: [singleDefaulted, monogamousDefaulted, divorcedDefaulted, widowedDefaulted, cohabitingDefaulted, unavailableDefaulted, polygamousDefaulted, notapplicableDefaulted]
            }, {
                name: 'Active Missed',
                data: [singleMissed, monogamousMissed, divorcedMissed, widowedMissed, cohabitingMissed, unavailableMissed, polygamousMissed, notapplicableMissed]
            },
            {
                name: 'Active LTFUs',
                data: [singleLTFU, monogamousLTFU, divorcedLTFU, widowedLTFU, cohabitingLTFU, unavailableLTFU, polygamousLTFU, notapplicableLTFU]
            }
        ],

    });

    var colors = Highcharts.getOptions().colors;
    </script>




</div>
</div>
                <!-- end of col -->

@endsection
