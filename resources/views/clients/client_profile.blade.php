@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
            <div style="margin-bottom:10px; ">
                <div class="Search_Modal" style="display: inline;">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-search"></i>
                        Search Client
                    </button>
                </div>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Search Client</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <div class="search_field">
                                    <input type="text" class="upn_search form-control" id="upn_search" name="upn_search" placeholder="Please Enter UPN No : " />
                                </div>

                                <div class="loading_div" style="display: none;">
                                    <span>Loading ....Please wait .....</span>
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="search_upn_btn btn btn-default pull-left"><i class=" fa fa-search"></i>Search</button>
                                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-stop-circle-o"></i>Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">

                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                                <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#appointments" role="tab">Appointments</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#outgoing" role="tab">Outgoing Messages</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#incoming" role="tab">Incoming Messages</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#wellness" role="tab">Wellness</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#outcomes" role="tab">Appointment Outcomes</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active " id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <th>Mobile</th>
                                                            <th>Marital Status</th>
                                                            <th>Language</th>
                                                            <th>Client Condition</th>
                                                            <th>Date of Birth</th>
                                                            <th>Enrollment Date</th>
                                                            <th>ART Date</th>
                                                            <th>Group</th>
                                                            <th>Status</th>
                                                            <th>CCC Number</th>
                                                            <th>File Number</th>
                                                            <th>Gender</th>
                                                            <th>Sms Enable</th>
                                                            <th>Consent Date</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @if (count($client_profile) > 0)
                                                        @foreach($client_profile as $result)
                                                        <tr>
                                                            <td> {{$result->client_name }}</td>
                                                            <td> {{$result->phone_no}}</td>
                                                            <td> {{$result->marital}}</td>
                                                            <td> {{$result->language}}</td>
                                                            <td> {{$result->client_status}}</td>
                                                            <td> {{$result->dob}}</td>
                                                            <td> {{$result->enrollment_date}}</td>
                                                            <td> {{$result->art_date}}</td>
                                                            <td> {{$result->group_name}}</td>
                                                            <td> {{$result->status}}</td>
                                                            <td> {{$result->clinic_number}}</td>
                                                            <td> {{$result->file_no}}</td>
                                                            <td> {{$result->gender}}</td>
                                                            <td> {{$result->smsenable}}</td>
                                                            <td> {{$result->consent_date}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="tab-pane " id="appointments" role="tabpanel">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Total Appointments : </strong>
                                                <br>
                                                <p class="text-muted all_appointments"></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r "> <strong>Future Appointments : </strong>
                                                <br>
                                                <p class="text-muted current_appointments"></p>
                                            </div>

                                            <div class="col-md-3 col-xs-6"> <strong>Kept Appointments : </strong>
                                                <br>
                                                <p class="text-muted kept_appointments "></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Missed Appointments : </strong>
                                                <br>
                                                <p class="text-muted missed_appointments "></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Defaulted Appointments : </strong>
                                                <br>
                                                <p class="text-muted defaulted_appointments"></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r "> <strong>LTFU Appointments : </strong>
                                                <br>
                                                <p class="text-muted LTFU_appointments"></p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r "> <strong>No of Appointments by Type: </strong>
                                                <ul class=" text-muted client_appointment_types"></ul>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                                <!--second tab-->

                                <div class="tab-pane" id="outgoing" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="outgoing_messages_logs_div col-xs-6 col-md-6" id="outgoing_messages_logs_div"></div>

                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="incoming" role="tabpanel">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="incoming_messages_logs_div" id="incoming_messages_logs_div"></div>

                                             
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="wellness" role="tabpanel">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="wellness_messages_logs_div" id="wellness_messages_logs_div"></div>

                                        </div>

                                    </div>
                                </div>



                                <div class="tab-pane" id="outcomes" role="tabpanel">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="appointment_outcomes_log_div" id="appointment_outcomes_log_div"></div>

                                        </div>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <!-- End PAge Content -->
            </div>

        </div>

    </div>
</div>
</div>

@endsection

@section('page-js')

<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>

<script type="text/javascript">
    $('#multicolumn_ordering_table').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }],
        "paging": true,
        "responsive": true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


@endsection