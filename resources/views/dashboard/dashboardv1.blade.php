@extends('layouts.master')
@section('main-content')
<div class="breadcrumb">
                <h1>Dashboard</h1>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li></li>
                </ul>
            </div>

            <div class="separator-breadcrumb border-top"></div>

<div class="col-md-12">

    <form role="form" method="post" action="#" id="dataFilter">
        {{ csrf_field() }}
        <div class="row">
            <div class="col">
                <div class="form-group">

                    <select class="form-control filter_partner  input-rounded input-sm select2 step2-select" id="partners" name="partners">
                        <option value="">Please select Service</option>
                        @foreach ($all_partners as $partner => $value)
                        <option value="{{ $partner }}"> {{ $value }}</option>
                        @endforeach

                        <option></option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <select class="form-control county  input-rounded input-sm select2 step2-select" id="counties" name="counties">
                        <option value="">Please select Unit:</option>
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <span class="filter_facility_wait" style="display: none;">Loading , Please Wait ...</span>
                    <select class="form-control filter_facility input-rounded input-sm select2" id="facilities" name="facilities">
                        <option value="">Please select Facility : </option>
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <button class="btn btn-default filter btn-round  btn-small btn-primary  " type="submit" > <i class="fa fa-filter"></i>
                        Filter</button>
                </div>
            </div>
        </div>

    </form>

</div>
<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <!-- ICON BG -->
    <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Target Active Clients</p>

                    <p id="all_target_clients" class="text-primary text-20 line-height-1 mb-2"></p>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <div class="content">
                    <p class="text-muted mt-2 mb-0">No. of Active Clients</p>
                    <p id="all_clients_number" class="text-primary text-20 line-height-1 mb-2"></p>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <div class="content">
                    <p class="text-muted mt-2 mb-0">% No. of Active Clients</p>
                    <p id="pec_client_count" class="text-primary text-20 line-height-1 mb-2"></p>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Consented Clients</p>
                    <p id="all_consented_clients" class="text-primary text-20 line-height-1 mb-2"></p>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-2">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Future Appointments</p>
                    <p id="all_future_appointments" class="text-primary text-20 line-height-1 mb-2"></p>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-2">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <div class="content">
                    <a class="has-arrow" href="{{route('Reports-active-facilities')}}">
                        <p class="text-muted mt-2 mb-0">No. of Facilities</p>
                    </a>
                    <p id="number_of_facilities" class="text-primary text-20 line-height-1 mb-2"></p>

                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-body">

                <div id="mainGraph" class="col" style="height: 450px;margin-top:40px;"></div> <br />

            </div>
        </div>
    </div>
</div>

<div id="dashboard_overlay">
    <img style="  position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    width: 100%;
    height: 100%;
    margin:auto;" src="{{url('/images/loader.gif')}}" alt="loader" />

</div>


@endsection

@section('page-js')

<script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/themes/high-contrast-light.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="partners"]').on('change', function() {
            var partnerID = $(this).val();
            if (partnerID) {
                $.ajax({
                    url: '/get_dashboard_units/' + partnerID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        console.log("units",data);
                        $('select[name="counties"]').empty();
                        $('select[name="counties"]').append('<option value="">Please Unit</option>');
                        $.each(data, function(key, value) {
                            $('select[name="counties"]').append('<option value="' + key + '">' + value + '</option>');
                        });


                    }
                });
            } else {
                $('select[name="counties"]').empty();
            }
        });
    });


    $(document).ready(function() {
        $('select[name="counties"]').on('change', function() {
            var countyID = $(this).val();
            if (countyID) {
                $.ajax({
                    url: '/get_dashboard_facilities/' + countyID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {


                        $('select[name="facilities"]').empty();
                        $('select[name="facilities"]').append('<option value="">Please Select Facility</option>');
                        $.each(data, function(key, value) {
                            $('select[name="facilities"]').append('<option value="' + key + '">' + value + '</option>');
                        });


                    }
                });
            } else {
                $('select[name="facilities"]').empty();
            }
        });
    });

    $.ajax({
        type: 'GET',
        url: "{{ route('dashboard_data') }}",
        success: function(data) {

            console.log("data here", data)

            charts(data.registered_clients_count,data.consented_clients_count );
            $("#all_clients_number").html(data.all_clients_number);
            $("#pec_client_count").html(data.pec_client_count);
            $("#all_target_clients").html(data.all_target_clients);
            $("#all_consented_clients").html(data.all_consented_clients);
            $("#all_future_appointments").html(data.all_future_appointments);
            $("#number_of_facilities").html(data.number_of_facilities);

            //mainChart.redraw();

            console.log(data.consented_clients_count);

            $("#dashboard_overlay").hide();

        }
    });


    $('#dataFilter').on('submit', function(e) {
        e.preventDefault();
        $("#dashboard_overlay").show();

        let partners = $('#partners').val();
        let counties = $('#counties').val();
        let facilities = $('#facilities').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            data: {
                "partners": partners,
                "counties": counties,
                "facilities": facilities
            },
            url: "{{ route('filter_dashboard') }}",
            success: function(data) {

                console.log("filtered data here", data)
                charts(data.registered_clients_count,data.consented_clients_count );

                $("#all_clients_number").html(data.all_clients_number);
                $("#pec_client_count").html(data.pec_client_count);
                $("#all_target_clients").html(data.all_target_clients);
                $("#all_consented_clients").html(data.all_consented_clients);
                $("#all_future_appointments").html(data.all_future_appointments);
                $("#number_of_facilities").html(data.number_of_facilities);

                console.log(data.consented_clients_count);
                $("#dashboard_overlay").hide();

            }
        });

    });

</script>

<script>

    function charts(reg_clients, cons_clients) {

        console.log("my chart",reg_clients, cons_clients)

        let all_clients = parseInt(reg_clients);
        let all_cons = parseInt(cons_clients);

        var mainChart = Highcharts.chart('mainGraph', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Number Series'
            },
            xAxis: {
                categories: ['Registered Clients', 'Consented Clients']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Count'
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
                        'Total Clients: ' + this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                }
            },
            series: [{

                name: 'Clients Trends',
                data: [all_clients, all_cons]
            }],
        });
    }

</script>
@endsection