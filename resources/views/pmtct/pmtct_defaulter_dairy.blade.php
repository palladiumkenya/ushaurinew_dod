@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">

@endsection
@section('main-content')

<div class="breadcrumb">
                <ul>
                    <li><a href="">PMTCT Defaulter Diary</a></li>
                    <li></li>
                </ul>
            </div>


            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card mb-4">
                    <div class="panel-heading">
                      <i class="icon-table">{{count($all_missed_appointment_clients)}} Missed PMTC Mothers List</i>
                     </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                                <table id="pmtct_missed_table" class="display table table-striped table-bordered" style="width:50%">
                                                <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>KDOD Number</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Appointment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_missed_appointment_clients) > 0)
                                                @foreach($all_missed_appointment_clients as $clients)
                                                    <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td> {{ ucwords($clients->clinic_number)}}</td>
                                                    <td>  {{$clients->f_name}}</td>
                                                    <td>  {{$clients->m_name}}</td>
                                                    <td>  {{$clients->l_name}}</td>
                                                    <td>  {{$clients->appntmnt_date}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                      </table>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                    <div class="panel-heading">
                         <i class="icon-table">{{count($all_defaulted_appointment_clients)}} Defaulted PMTCT Mothers List</i>
                          </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                                <table id="pmtct_defaulted_table" class="display table table-striped table-bordered" style="width:50%">
                                                <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>KDOD Number</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Appointment Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_defaulted_appointment_clients) > 0)
                                                @foreach($all_defaulted_appointment_clients as $clients)
                                                    <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td> {{ ucwords($clients->clinic_number)}}</td>
                                                    <td>  {{$clients->f_name}}</td>
                                                    <td>  {{$clients->m_name}}</td>
                                                    <td>  {{$clients->l_name}}</td>
                                                    <td>  {{$clients->appntmnt_date}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                     </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card mb-4">
                    <div class="panel-heading">
                      <i class="icon-table">{{count($all_ltfu_pmtct_clients)}} Lost To Follow Up PMTCT Mothers List</i>
                     </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                                <table id="pmtct_ltfu_table" class="display table table-striped table-bordered" style="width:50%">
                                                <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>KDOD Number</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Appointment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_ltfu_pmtct_clients) > 0)
                                                @foreach($all_ltfu_pmtct_clients as $clients)
                                                    <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td> {{ ucwords($clients->clinic_number)}}</td>
                                                    <td>  {{$clients->f_name}}</td>
                                                    <td>  {{$clients->m_name}}</td>
                                                    <td>  {{$clients->l_name}}</td>
                                                    <td>  {{$clients->appntmnt_date}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
     </div>



@endsection

@section('page-js')


     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"> </script>
     <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>

     <script type="text/javascript">

$('#pmtct_missed_table').DataTable({
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
        "responsive":true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            {
            extend: 'copy',
            title: 'Missed PMTCT List',
            filename: 'Missed PMTCT List'
            },
            {
            extend: 'csv',
            title: 'Missed PMTCT List',
            filename: 'Missed PMTCT List'
            },
            {
            extend: 'excel',
            title: 'Missed PMTCT List',
            filename: 'Missed PMTCT List'
            },
            {
            extend: 'pdf',
            title: 'Missed PMTCT List',
            filename: 'Missed PMTCT List'
            },
            {
            extend: 'print',
            title: 'Missed PMTCT List',
            filename: 'Missed PMTCT List'
            }
        ]
    });
    $('#pmtct_defaulted_table').DataTable({
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
        "responsive":true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            {
            extend: 'copy',
            title: 'Defaulted PMTCT List',
            filename: 'Defaulted PMTCT List'
            },
            {
            extend: 'csv',
            title: 'Defaulted PMTCT List',
            filename: 'Defaulted PMTCT List'
            },
            {
            extend: 'excel',
            title: 'Defaulted PMTCT List',
            filename: 'Defaulted PMTCT List'
            },
            {
            extend: 'pdf',
            title: 'Defaulted PMTCT List',
            filename: 'Defaulted PMTCT List'
            },
            {
            extend: 'print',
            title: 'Defaulted PMTCT List',
            filename: 'Defaulted PMTCT List'
            }
        ]
    });
    $('#pmtct_ltfu_table').DataTable({
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
        "responsive":true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            {
            extend: 'copy',
            title: 'LTFU PMTCT List',
            filename: 'LTFU PMTCT List'
            },
            {
            extend: 'csv',
            title: 'LTFU PMTCT List',
            filename: 'LTFU PMTCT List'
            },
            {
            extend: 'excel',
            title: 'LTFU PMTCT List',
            filename: 'LTFU PMTCT List'
            },
            {
            extend: 'pdf',
            title: 'LTFU PMTCT List',
            filename: 'LTFU PMTCT List'
            },
            {
            extend: 'print',
            title: 'LTFU PMTCT List',
            filename: 'LTFU PMTCT List'
            }
        ]
    });
     // multi column ordering

        </script>

@endsection
