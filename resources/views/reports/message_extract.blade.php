@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                        <! <h4 class="card-title mb-3">Messages Extract List</h4>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Clinic Number</th>
                                                <th>Gender</th>
                                                <th>Group</th>
                                                <th>Gender</th>
                                                <th>Marital Status</th>
                                                <th>Text Time</th>
                                                <th>Language</th>
                                                <th>Message Type</th>
                                                <th>Message Month Year</th>
                                                <th>Message</th>
                                                <th>Partner</th>
                                                <th>County</th>
                                                <th>Sub County</th>
                                                <th>MFL Code</th>
                                                <th>Facility</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($message_extract) > 0)
                                                @foreach($message_extract as $message)
                                                    <tr>
                                                        <td> {{ $message->clinic_number }}</td>
                                                        <td>  {{$message->gender}}</td>
                                                        <td>  {{$message->group_name}}</td>
                                                        <td>  {{$message->Gender}}</td>
                                                        <td>  {{$message->marital}}</td>
                                                        <td>  {{$message->preferred_time}}</td>
                                                        <td>  {{$message->language}}</td>
                                                        <td>  {{$message->message_type}}</td>
                                                        <td>  {{$message->month_year}}</td>
                                                        <td>  {{$message->msg}}</td>
                                                        <td>  {{$message->partner_name}}</td>
                                                        <td>  {{$message->county}}</td>
                                                        <td>  {{$message->sub_county}}</td>
                                                        <td>  {{$message->mfl_code}}</td>
                                                        <td>  {{$message->facility_name}}</td>
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
