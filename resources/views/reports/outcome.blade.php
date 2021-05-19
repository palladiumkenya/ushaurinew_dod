@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                        <! <h4 class="card-title mb-3">Outcome Report</h4>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Clinic Number</th>
                                                <th>Age</th>
                                                <th>Facility</th>
                                                <th>Gender</th>
                                                <th>Sub County</th>
                                                <th>File No</th>
                                                <th>Appointment Date</th>
                                                <th>Date Came</th>
                                                <th>Tracer Name</th>
                                                <th>Days Defaulted</th>
                                                <th>Tracing Date</th>
                                                <th>Outcome</th>
                                                <th>Final Outcome</th>
                                                <th>Other Outcome</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($outcome_report) > 0)
                                                @foreach($outcome_report as $outcome)
                                                    <tr>
                                                        <td> {{ $outcome->UPN }}</td>
                                                        <td>  {{$outcome->Age}}</td>
                                                        <td>  {{$outcome->Facility}}</td>
                                                        <td>  {{$outcome->Gender}}</td>
                                                        <td>  {{$outcome->Sub_County}}</td>
                                                        <td>  {{$outcome->File_Number}}</td>
                                                        <td>  {{$outcome->Appointment_Date}}</td>
                                                        <td>  {{$outcome->Date_Came}}</td>
                                                        <td>  {{$outcome->Tracer}}</td>
                                                        <td>  {{$outcome->Days_Defaulted}}</td>
                                                        <td>  {{$outcome->Tracing_Date}}</td>
                                                        <td>  {{$outcome->Outcome}}</td>
                                                        <td>  {{$outcome->Final_Outcome}}</td>
                                                        <td>  {{$outcome->Other_Outcome}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>

                                </div>

                        </div>
                    </div>
                </div>
                <!-- end of col -->

@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
 <script type="text/javascript">
   // multi column ordering
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
        "responsive":true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });</script>


@endsection
