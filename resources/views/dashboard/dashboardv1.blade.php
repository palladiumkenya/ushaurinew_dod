@extends('layouts.master')
@section('main-content')
           <div class="breadcrumb">
                <ul>
                    <li><a href="">Dashboard</a></li>
                </ul>
            </div>

            <div class="separator-breadcrumb border-top"></div>

    </form>
    <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <!-- ICON BG -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Target Active Clients</p>

                                <p class="text-primary text-20 line-height-1 mb-2"><?php echo $all_target_clients; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">No. of Active Clients</p>
                                <p class="text-primary text-20 line-height-1 mb-2"><?php echo $all_clients_number; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">% No. of Active Clients</p>
                                <p class="text-primary text-20 line-height-1 mb-2"><?php echo $pec_client_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Consented Clients</p>
                                <p class="text-primary text-20 line-height-1 mb-2"><?php echo $all_consented_clients; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-2">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Future Appointments</p>
                                <p class="text-primary text-20 line-height-1 mb-2"><?php echo $all_future_appointments; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-2">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">No. of Facilities</p>
                                <p class="text-primary text-20 line-height-1 mb-2"><?php echo $number_of_facilities; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">

                        <div id="container" class="col" style="height: 450px;margin-top:40px;"></div> <br />

                        </div>
                    </div>
                </div>
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

var RegisteredClients =  <?php echo json_encode($registered_clients) ?>;
var ConsentedClients =  <?php echo json_encode($consented_clients) ?>;
var Months =  <?php echo json_encode($month_count) ?>;

console.log(ConsentedClients);
        Highcharts.chart('container', {
            chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Number Series'
        },
        xAxis: {
            type: 'date',
            categories: Months
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
        series: [{
            name: 'Registered Clients',
            data: RegisteredClients
        }, {
            name: 'Consented Clients',
            data: RegisteredClients
        }]

    });

    var colors = Highcharts.getOptions().colors;


        </script>

@endsection