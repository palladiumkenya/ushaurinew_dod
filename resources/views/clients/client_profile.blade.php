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
                        <input type="text" class="upn_search form-control" id="upn_search" name="upn_search" placeholder="Please Enter UPN No : "/>
                    </div>

                    <div class="loading_div" style="display: none;">
                        <span>Loading ....Please wait .....</span>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="search_upn_btn btn btn-default pull-left" ><i class=" fa fa-search"></i>Search</button>
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
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted client_name"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r "> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted phone_no"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Marital Status</strong>
                                        <br>
                                        <p class="text-muted marital"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Language </strong>
                                        <br>
                                        <p class="text-muted language "></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Client Condition</strong>
                                        <br>
                                        <p class="text-muted client_status"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r "> <strong>Date of Birth </strong>
                                        <br>
                                        <p class="text-muted dob"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Enrollment Date </strong>
                                        <br>
                                        <p class="text-muted enrollment_date"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>ART Date  </strong>
                                        <br>
                                        <p class="text-muted art_date"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r "> <strong>Group  </strong>
                                        <br>
                                        <p class="text-muted group"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Status </strong>
                                        <br>
                                        <p class="text-muted status"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>CCC  Number    </strong>
                                        <br>
                                        <p class="text-muted clinic_number"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>File  Number    </strong>
                                        <br>
                                        <p class="text-muted file_no"></p>
                                    </div>
                                      <div class="col-md-3 col-xs-6"> <strong>Gender      </strong>
                                        <br>
                                        <p class="text-muted gender_name"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Sms Enable      </strong>
                                        <br>
                                        <p class="text-muted gender_name"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Consent Date      </strong>
                                        <br>
                                        <p class="text-muted gender_name"></p>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane " id="appointments" role="tabpanel">
                            <div class="card-body" >

                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Total Appointments : </strong>
                                        <br>
                                        <p class="text-muted all_appointments"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r "> <strong>Future Appointments : </strong>
                                        <br>
                                        <p class="text-muted current_appointments"></p>
                                    </div>

                                    <div class="col-md-3 col-xs-6"> <strong>Kept Appointments :  </strong>
                                        <br>
                                        <p class="text-muted kept_appointments "></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Missed Appointments :  </strong>
                                        <br>
                                        <p class="text-muted missed_appointments "></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Defaulted Appointments : </strong>
                                        <br>
                                        <p class="text-muted defaulted_appointments"></p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r "> <strong>LTFU Appointments :  </strong>
                                        <br>
                                        <p class="text-muted LTFU_appointments"></p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r "> <strong>No of Appointments  by Type:  </strong>
                                        <ul class=" text-muted client_appointment_types"></ul>
                                    </div>
                                </div>




                            </div>
                        </div>
                        <!--second tab-->

                        <div class="tab-pane" id="outgoing" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    <div class="outgoing_messages_logs_div col-xs-6 col-md-6" id="outgoing_messages_logs_div" ></div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane" id="incoming" role="tabpanel">
                            <div class="card-body">

                                <div class="row">
                                    <div class="incoming_messages_logs_div" id="incoming_messages_logs_div" ></div>

                                     </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="wellness" role="tabpanel">
                            <div class="card-body">

                                <div class="row">
                                    <div class="wellness_messages_logs_div" id="wellness_messages_logs_div" ></div>

                                </div>

                            </div>
                        </div>



                        <div class="tab-pane" id="outcomes" role="tabpanel">
                            <div class="card-body">

                                <div class="row">
                                    <div class="appointment_outcomes_log_div" id="appointment_outcomes_log_div" ></div>

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

$(document).ready(function () {



function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
    }
    return val;
}



$(".search_upn_btn").click(function () {

    $(".generated_profile_div").show();



    var upn = $(".upn_search").val();

    // Does some stuff and logs the event to the console


    $.ajax({
        url: "{{ route('clients-profile') }}",
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $(".client_name").empty();
            $(".client_status").empty();
            $(".dob").empty();
            $(".enrollment_date").empty();
            $(".art_date").empty();
            $(".group").empty();
            $(".gender").empty();
            $(".language").empty();
            $(".marital").empty();
            $(".phone_no").empty();
            $(".status").empty();
            $(".clinic_number").empty();
            var isempty = jQuery.isEmptyObject(data);
            if (isempty) {
                swal("Sorry", "Clininc number : " + upn + " was not found in the  system  ", "info");
            } else {


                $.each(data, function (i, value) {
                    $(".client_name").append("Client Name : " + value.f_name + " " + value.m_name + " " + value.l_name);
                    $(".client_status").append("Client Status" + value.client_status);
                    $(".dob").append("Date of Birth " + value.dob);
                    $(".enrollment_date").append("Enrollment Date : " + value.enrollment_date);
                    $(".art_date").append("ART Start Date : " + value.art_date);
                    $(".group").append("Groupi : " + value.group_name);
                    $(".gender").append("Language  : " + value.gender_name);
                    $(".language").append("Language  : " + value.language_name);
                    $(".marital").append("Marital Status : " + value.marital);
                    $(".phone_no").append("Phone No : " + value.phone_no);
                    $(".status").append("Status : " + value.status);
                    $(".clinic_number").append("Clinic Number : " + value.clinic_number);
                });


            }



        }, error: function (jqXHR) {
            swal("Error", "Clininc number already exists and is registered under : " + upn + " ", "warning");
        }
    });






});


});


 </script>


@endsection