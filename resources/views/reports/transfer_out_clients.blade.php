@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                         <h4 class="card-title mb-3">Transfer Out Client List</h4>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="transfer_out_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>UPN</th>
                                                <th>Serial No</th>
                                                <th>Client Name</th>
                                                <th>Phone No</th>
                                                <th>DOB</th>
                                                <th>Type</th>
                                                <th>Condition</th>
                                                <th>Previous Clinic</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_transfer_clients) > 0)
                                                @foreach($all_transfer_clients as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->file_no}}</td>
                                                        <td>  {{$result->full_name}}</td>
                                                        <td>  {{$result->phone_no}}</td>
                                                        <td>  {{$result->dob}}</td>
                                                        <td>  {{$result->name}}</td>
                                                        <td>  {{$result->client_status}}</td>
                                                        <td>  {{$result->clinic_previous}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>

                                </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                         <h4 class="card-title mb-3">Transfer In Client List</h4>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="transfer_in_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>UPN</th>
                                                <th>Serial No</th>
                                                <th>Client Name</th>
                                                <th>Phone No</th>
                                                <th>DOB</th>
                                                <th>Type</th>
                                                <th>Condition</th>
                                                <th>Previous Clinic</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_transfer_in) > 0)
                                                @foreach($all_transfer_in as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->file_no}}</td>
                                                        <td>  {{$result->full_name}}</td>
                                                        <td>  {{$result->phone_no}}</td>
                                                        <td>  {{$result->dob}}</td>
                                                        <td>  {{$result->name}}</td>
                                                        <td>  {{$result->client_status}}</td>
                                                        <td>  {{$result->clinic_previous}}</td>
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
   $('#transfer_out_table').DataTable({
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
    });
    $('#transfer_in_table').DataTable({
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
    });
    </script>


@endsection
