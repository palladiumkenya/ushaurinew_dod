<!-- start sidebar -->
<div class="sidebar-panel">
    <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center">
        <img class="pl-3" src="{{ asset('assets/images/ushauri.jpeg') }}" alt="ushauri">
        <!-- <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
        <div class="sidebar-compact-switch ml-auto"><span></span></div>

    </div>
    <!-- user -->
    <div class="scroll-nav" data-perfect-scrollbar data-suppress-scroll-x="true">

        <!-- user close -->
        <!-- side-nav start -->
        <div class="side-nav">

            <div class="main-menu">

                <!-- <ul>
                            <li>
                                <a href="*" class="active-color">
                                    <span class="item-name ">Dashboard</span>
                                    <span class="spacer"></span>
                                    <span class="item-badge badge badge-warning">100+</span>
                                </a>
                            </li>

                        </ul> -->
                <ul class="metismenu" id="menu">
                    <!-- <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">Apps</p> -->
                    <li class="Ul_li--hover">
                        <a class="has-arrow" href="#">
                            <i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                            <span class="item-name  text-muted">Dashboard</span>
                        </a>
                        <ul class="mm-collapse">
                            <li class="item-name">
                              @if (Auth::user()->access_level == 'Facility')
                                <a class="" href="{{route('Reports-facility_home')}}">
                                    <i class="i-Circular-Point  mr-2 text-muted"></i>
                                    <span class=" text-muted">Summary</span>
                                </a>
                                @endif
                                @if (Auth::user()->access_level == 'Admin')
                                <a class="" href="{{route('Reports-dashboard')}}">
                                    <i class="i-Circular-Point  mr-2 text-muted"></i>
                                    <span class=" text-muted">Summary</span>
                                </a>
                                @endif
                                @if (Auth::user()->access_level == 'Partner')
                                <a class="" href="{{route('Reports-dashboard')}}">
                                    <i class="i-Circular-Point  mr-2 text-muted"></i>
                                    <span class=" text-muted">Summary</span>
                                </a>
                                @endif
                            </li>
                            <li class="item-name">
                            <a class="" href="{{route('report-appointment-dashboard')}}">
                                    <i class="i-Circular-Point  mr-2 text-muted"></i>
                                    <span class=" text-muted">Appointments</span>
                                </a>
                            </li>
                            <li class="item-name">
                                <a class="" href="dashboard.v4.html">
                                    <i class="i-Circular-Point  mr-2 text-muted"></i>
                                    <span class=" text-muted">Messages</span>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="Ul_li--hover">
                        <a class="has-arrow" href="#">
                            <i class="i-Library text-20 mr-2 text-muted"></i>

                            <span class="item-name  text-muted">Clients</span>
                        </a>
                        <ul class="mm-collapse">
                            <li class="item-name">
                                <a href="alerts.html">
                                    <i class="nav-icon i-Bell1"></i>
                                    <span class="item-name">Client Profile</span>
                                </a>
                            </li>
                            <li class="item-name">
                            <li class="nav-item">
                            <a href={{route('report-clients-list')}}>
                                    <i class="nav-icon i-Bell1"></i>
                                    <span class="item-name">Clients</span>
                                </a>
                            </li>
                    </li>
                    <li class="item-name">
                        <a href="buttons.html">
                            <i class="nav-icon i-Cursor-Click"></i>
                            <span class="item-name">Client Extract</span>
                        </a>
                    </li>
                    @if (Auth::user()->access_level == 'Admin' || Auth::user()->access_level == 'Partner')
                    <li class="item-name">
                        <a href={{route('upload-clients-form')}}>
                            <i class="nav-icon i-Cursor-Click"></i>
                            <span class="item-name">Upload Clients</span>
                        </a>
                    </li>
                    @endif
                </ul>
                </li>
                <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                        <i class="i-Suitcase text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Appointments</span>
                    </a>
                    <ul class="mm-collapse">
                    <li class="item-name">
                            <a class="has-arrow cursor-pointer">
                                <i class="nav-icon i-Receipt"></i>
                                <span class="item-name">App Diary </span>

                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                <a href="{{route('get_future_appointments')}}">
                                        <i class="nav-icon i-Receipt"></i>
                                        <span class="item-name">Future</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="item-name">
                            <a class="has-arrow cursor-pointer">
                                <i class="nav-icon i-Receipt"></i>
                                <span class="item-name">Defaulter Diary </span>

                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                <a href={{route('report-appointments-missed')}}>
                                        <i class="nav-icon i-Receipt"></i>
                                        <span class="item-name">Missed</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                <a href={{route('report-appointments-defaulted')}}>
                                        <i class="nav-icon i-Receipt"></i>
                                        <span class="item-name">Defaulted</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                <a href={{route('report-appointments-ltfu_clients')}}>
                                        <i class="nav-icon i-Receipt"></i>
                                        <span class="item-name">Lost To Follow Up</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="item-name">
                            <a href="">
                                <i class="nav-icon i-Approved-Window"></i>
                                <span class="item-name">Edit Appointment</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href="{{route('report-appointments')}}">
                                <i class="nav-icon i-Plane"></i>
                                <span class="item-name">Appointments</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href=>
                                <i class="nav-icon i-Data-Upload"></i>
                                <span class="item-name">Appointment Diary</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href={{route('report-appointments-calender')}}>
                                <i class="nav-icon i-Data-Upload"></i>
                                <span class="item-name">Calender</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                        <i class="i-Computer-Secure text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Wellness</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                        <a href={{route('report-ok_clients')}}>
                                <i class="nav-icon i-Business-Mens"></i>
                                <span class="item-name">Ok</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href={{route('report-not_ok_clients')}}>
                                <i class="nav-icon i-Add-File"></i>
                                <span class="item-name">Not Ok</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href={{route('report-unrecognised_response')}}>
                                <i class="nav-icon i-Email"></i>
                                <span class="item-name">Unrecognised</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
                <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                        <i class="i-Computer-Secure text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Groups</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                        <a href={{route('report-adolescent_clients')}}>
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Adolescent</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href={{route('report-pmtct_clients')}}>
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">PMTCT</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href={{route('report-adults_clients')}}>
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Adult</span>
                            </a>
                        </li>
                        <li class="item-name">
                        <a href={{route('report-paeds_clients')}}>
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Paeds </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                        <i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Admin Tools</span>
                    </a>
                    <ul class="mm-collapse">
                    @if (Auth::user()->access_level == 'Admin')
                        <li class="item-name">
                            <a class="" href="charts.echarts.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Donor</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Partner</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Groups</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Facilities</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href={{route('admin-users')}}>
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Users</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Content</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Module Mngr</span>
                            </a>
                        </li>

                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Counties</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Sender</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Roles</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Language</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Notification Conf</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Role Modules</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">County Tier</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Broadcast</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Manual SMS</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->access_level == 'Facility')
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Broadcast</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="charts.chartsjs.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Manual SMS</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                        <i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Reports</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                            <a href="form.basic.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Lab Investigation</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="basic-action-bar.html">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Appointment Report</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="form.layouts.html">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Broadcast Report</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="multi-column-forms.html">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">My Facilities</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('report-deactivated_clients')}}">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Deactivated</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="form.validation.html">
                                <i class="nav-icon i-Close-Window"></i>
                                <span class="item-name">Messages Extract</span>
                            </a>
                        </li>
                 <li class="item-name">
                        <a class="has-arrow" href="#">
                        <i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">PMTCT Reports</span>
                    </a>
                    <ul class="mm-collapse">
                    <li class="item-name">
                            <a href="{{route('get_pmtct_booked_clients')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Summary</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('get_pmtct_booked_clients')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Clients Booked</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_pmtct_honored_appointment')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Appointments Kept</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('get_pmtct_scheduled_appointments')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Scheduled Appointments</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('get_pmtct_unscheduled_appointments')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Unscheduled Appointments</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_pmtct_missed_clients')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Missed Clients</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_pmtct_defaulted_clients')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Defaulted Clients</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_pmtct_ltfu_clients')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Lost To Follow Up</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_deceased_clients')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Deceased</span>
                            </a>
                        </li>
                        </ul>
                        </li>

                        <li class="item-name">
                        <a class="has-arrow" href="#">
                        <i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Hei Reports</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                            <a href="{{route('report-all_heis')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Summary</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('report-all_heis')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">All Hei</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('report-booked_heis')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Hei Booked</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('report-unscheduled_heis')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Unscheduled</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('report-scheduled_heis')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Scheduled</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('report-missed_heis')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Missed</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('report-defaulted_heis')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Defaulted</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('report-ltfu_heis')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Lost To Follow Up</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('report-deceased_heis')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">Deceased</span>
                            </a>
                        </li>
                        </ul>
                        </li>
                        <li class="item-name">
                        <a class="has-arrow" href="#">
                        <i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">DCM Reports</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                            <a href="{{route('get_dcm_less_well')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Less Well</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_dcm_less_advanced')}}">
                                <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                                <span class="item-name">Less Advanced</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="{{route('get_dcm_more_stable')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">More Stable</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a class="" href="{{route('get_dcm_more_unstable')}}">
                                <i class="nav-icon i-Split-Vertical"></i>
                                <span class="item-name">More Unstable</span>
                            </a>
                        </li>
                        </ul>
                        </li>
                        <li class="item-name">
                            <a href="smart.wizard.html">
                                <i class="nav-icon i-Width-Window"></i>
                                <span class="item-name">Transfers</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="smart.wizard.html">
                                <i class="nav-icon i-Width-Window"></i>
                                <span class="item-name">Consented Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="Ul_li--hover">
                    <a class="" href="datatables.html">
                        <i class="i-File-Horizontal-Text text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Datatables</span>
                    </a>
                </li> -->
                <!-- <li class="Ul_li--hover">
                    <a class="has-arrow">
                        <i class="i-Administrator text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Sessions</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                            <a href="signin.html">
                                <i class="nav-icon i-Checked-User"></i>
                                <span class="item-name">Sign in</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="signup.html">
                                <i class="nav-icon i-Add-User"></i>
                                <span class="item-name">Sign up</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="forgot.html">
                                <i class="nav-icon i-Find-User"></i>
                                <span class="item-name">Forgot</span>
                            </a>
                        </li>

                    </ul>
                </li> -->
                <!-- <li class="Ul_li--hover">
                    <a class="has-arrow">
                        <i class="i-Double-Tap text-20 mr-2 text-muted"></i>
                        <span class="item-name  text-muted">Others</span>
                    </a>
                    <ul class="mm-collapse">
                        <li class="item-name">
                            <a href="not.found.html">
                                <i class="nav-icon i-Error-404-Window"></i>
                                <span class="item-name">Not Found</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="user.profile.html">
                                <i class="nav-icon i-Male"></i>
                                <span class="item-name">User Profile</span>
                            </a>
                        </li>
                        <li class="item-name">
                            <a href="blank.html" class="open">
                                <i class="nav-icon i-File-Horizontal"></i>
                                <span class="item-name">Blank Page</span>
                            </a>
                        </li>

                    </ul>
                </li> -->
                <li class="Ul_li--hover">
                <a class="dropdown-item" href="{{route('logout')}}"><i class="nav-icon i-Power-3"></i>Log out</a>
                </li>

                </ul>
            </div>
        </div>
    </div>

    <!-- side-nav-close -->
</div>
<!-- end sidebar -->
<div class="switch-overlay"></div>