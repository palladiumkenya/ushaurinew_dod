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

    <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body row">

                    <div class="row">
                        <div class="col-12">

                            <div class="card-body row">
                                <div id="container" class="col" style="height:  350px;margin-top:20px;width: 900px"></div> <br />
                            </div>

                        </div>
                    </div>


                </div>
            </div>
    </div>

    <script type="text/javascript">
    var Toone_scheduled =  <?php echo json_encode($toone_scheduled_heis) ?>;
    var ToFour_scheduled =  <?php echo json_encode($tofour_scheduled_heis) ?>;
    var ToNine_scheduled =  <?php echo json_encode($tonine_scheduled_heis) ?>;
    var ToFourteen_scheduled =  <?php echo json_encode($tofourteen_scheduled_heis) ?>;


    var Toone_unscheduled =  <?php echo json_encode($toone_unscheduled_heis) ?>;
    var ToFour_unscheduled =  <?php echo json_encode($tofour_unscheduled_heis) ?>;
    var ToNine_unscheduled =  <?php echo json_encode($tonine_unscheduled_heis) ?>;
    var ToFourteen_unscheduled =  <?php echo json_encode($tofourteen_unscheduled_heis) ?>;

    var Toone_booked =  <?php echo json_encode($toone_booked_heis) ?>;
    var ToFour_booked =  <?php echo json_encode($tofour_booked_heis) ?>;
    var ToNine_booked =  <?php echo json_encode($tonine_booked_heis) ?>;
    var ToFourteen_booked =  <?php echo json_encode($tofourteen_booked_heis) ?>;

    var Toone_defaulted =  <?php echo json_encode($toone_defaulted_heis) ?>;
    var ToFour_defaulted =  <?php echo json_encode($tofour_defaulted_heis) ?>;
    var ToNine_defaulted =  <?php echo json_encode($tonine_defaulted_heis) ?>;
    var ToFourteen_defaulted =  <?php echo json_encode($tofourteen_defaulted_heis) ?>;


    var Toone_missed =  <?php echo json_encode($toone_missed_heis) ?>;
    var ToFour_missed =  <?php echo json_encode($tofour_missed_heis) ?>;
    var ToNine_missed =  <?php echo json_encode($tonine_missed_heis) ?>;
    var ToFourteen_missed =  <?php echo json_encode($tofourteen_missed_heis) ?>;


    var Toone_ltfu =  <?php echo json_encode($toone_ltfu_heis) ?>;
    var ToFour_ltfu =  <?php echo json_encode($tofour_ltfu_heis) ?>;
    var ToNine_ltfu =  <?php echo json_encode($tonine_ltfu_heis) ?>;
    var ToFourteen_ltfu =  <?php echo json_encode($tofourteen_ltfu_heis) ?>;






  Highcharts.drawTable = function() {


// user options
var tableTop = 55,
    colWidth = 95,
    tableLeft = 100,
    rowHeight = 40,
    cellPadding = 6,
    valueDecimals = 0;

var chart = this,
    series = chart.series,
    renderer = chart.renderer,
    cellLeft = tableLeft;

// draw category labels
$.each(chart.xAxis[0].categories, function(i, name) {
    renderer.text(
            name,
            cellLeft + cellPadding,
            tableTop + (i + 2) * rowHeight - cellPadding
        )
        .css({
            fontWeight: 'bold'
        })
        .add();
});

$.each(series, function(i, serie) {
    cellLeft += colWidth;

    // Apply the cell text
    renderer.text(
            serie.name,
            cellLeft - cellPadding + colWidth,
            tableTop + rowHeight - cellPadding
        )
        .attr({
            align: 'right'
        })
        .css({
            fontWeight: 'bold'
        })
        .add();

    $.each(serie.data, function(row, point) {

        // Apply the cell text
        renderer.text(
                Highcharts.numberFormat(point.y, valueDecimals),
                cellLeft + colWidth - cellPadding,
                tableTop + (row + 2) * rowHeight - cellPadding
            )
            .attr({
                align: 'right'
            })
            .add();

        // horizontal lines
        if (row == 0) {
            Highcharts.tableLine( // top
                renderer,
                tableLeft,
                tableTop + cellPadding,
                cellLeft + colWidth,
                tableTop + cellPadding
            );
            Highcharts.tableLine( // bottom
                renderer,
                tableLeft,
                tableTop + (serie.data.length + 1) * rowHeight + cellPadding,
                cellLeft + colWidth,
                tableTop + (serie.data.length + 1) * rowHeight + cellPadding
            );
        }
        // horizontal line
        Highcharts.tableLine(
            renderer,
            tableLeft,
            tableTop + row * rowHeight + rowHeight + cellPadding,
            cellLeft + colWidth,
            tableTop + row * rowHeight + rowHeight + cellPadding
        );

    });

    // vertical lines
    if (i == 0) { // left table border
        Highcharts.tableLine(
            renderer,
            tableLeft,
            tableTop + cellPadding,
            tableLeft,
            tableTop + (serie.data.length + 1) * rowHeight + cellPadding
        );
    }

    Highcharts.tableLine(
        renderer,
        cellLeft,
        tableTop + cellPadding,
        cellLeft,
        tableTop + (serie.data.length + 1) * rowHeight + cellPadding
    );

    if (i == series.length - 1) { // right table border

        Highcharts.tableLine(
            renderer,
            cellLeft + colWidth,
            tableTop + cellPadding,
            cellLeft + colWidth,
            tableTop + (serie.data.length + 1) * rowHeight + cellPadding
        );
    }

});


};
Highcharts.tableLine = function(renderer, x1, y1, x2, y2) {
renderer.path(['M', x1, y1, 'L', x2, y2])
    .attr({
        'stroke': 'silver',
        'stroke-width': 1
    })
    .add();
}
window.chart = new Highcharts.Chart({

chart: {
    renderTo: 'container',
    events: {
        load: Highcharts.drawTable
    },
    borderWidth: 2
},

title: {
    text: 'Evaluation of Retention/Attendance Summary'
},

xAxis: {
    visible: false,
    categories: ['less 1', '1-4', '5-9', '10-14', 'Total']
},

yAxis: {
    visible: false
},

legend: {
    enabled: false
},
plotOptions: {
    series: {
        visible: false
    }
},

series: [{
    name: 'Booked',
    data: [Toone_booked, ToFour_booked, ToNine_booked, ToFourteen_booked]
},{
    name: 'Scheduled',
    data: [Toone_scheduled, ToFour_scheduled, ToNine_scheduled, ToFourteen_scheduled]
}, {
    name: 'Un-Scheduled',
    data: [Toone_unscheduled, ToFour_unscheduled, ToNine_unscheduled, ToFourteen_unscheduled]

}, {
    name: 'Defaulter',
    data: [Toone_defaulted, ToFour_defaulted, ToNine_defaulted, ToFourteen_defaulted]

}, {
    name: 'Missed',
    data: [Toone_missed, ToFour_missed, ToNine_missed, ToFourteen_missed]

}, {
    name: 'LTFU',
    data: [Toone_ltfu, ToFour_ltfu, ToNine_ltfu, ToFourteen_ltfu]

}]
});
    </script>




</div>
</div>
                <!-- end of col -->

@endsection
