@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')

<div class="col-md-12 mb-4">
<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body grey" id="allApps">
                                    <b><?php echo $clients_count; ?><br></b>
                                    Clients
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body grey" id="keptApps">
                                    <b>{{$consented_count}}<br></b>
                                    Consented Clients
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body grey" id="defaultedApps">
                                    <b>{{$appointment_count}}<br></b>
                                    Appointments
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body grey" id="missedApps">
                                    <b>{{$messages_count}}<br></b>
                                    Messages Sent
                                </div>
                            </div>
                        </div>

                        <div class=" col-lg-6 col-sm-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <i class="icon-table"></i>Today Appointments
                                            </div>


                                            <div class="table-responsive">
                                                <table id="today_appointment_table" class="display table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>UPN</th>
                                                            <th>Serial No</th>
                                                            <th>Client Name</th>
                                                            <th>Phone No</th>
                                                            <th>Appointment Date</th>
                                                            <th>Appointment Type</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                            @if (count($today_appointment) > 0)
                                                @foreach($today_appointment as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_no}}</td>
                                                        <td>  {{$result->file_no}}</td>
                                                        <td>  {{$result->client_name}}</td>
                                                        <td>  {{$result->client_phone_no}}</td>
                                                        <td>  {{$result->appntmnt_date}}</td>
                                                        <td>  {{$result->appointment_type}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                                </table>
                                            </div>



                                        </div>
                                    </div>
                                    <div class=" col-lg-6 col-sm-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <i class="icon-table"></i>Missed Appointments
                                            </div>


                                            <div class="table-responsive">
                                                <table id="missed_table" class="display table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>UPN</th>
                                                            <th>Serial No</th>
                                                            <th>Client Name</th>
                                                            <th>Phone No</th>
                                                            <th>Appointment Date</th>
                                                            <th>Appointment Type</th>
                                                            <th>Other Appointment Type</th>
                                                            <th>No of Actions</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if (count($missed_appoitment) > 0)
                                                @foreach($missed_appoitment as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->file_no}}</td>
                                                        <td>  {{$result->full_name}}</td>
                                                        <td>  {{$result->phone_no}}</td>
                                                        <td>  {{$result->appntmnt_date}}</td>
                                                        <td>  {{$result->name}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div class=" col-lg-6 col-sm-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <i class="icon-table"></i>Defaulted Appointments
                                            </div>


                                            <div class="table-responsive">
                                                <table id="defaulted_table" class="display table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>UPN</th>
                                                            <th>Serial No</th>
                                                            <th>Client Name</th>
                                                            <th>Phone No</th>
                                                            <th>Appointment Date</th>
                                                            <th>Appointment Type</th>
                                                            <th>Other Appointment Type</th>
                                                            <th>No of Actions</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if (count($defaulted_appoitment) > 0)
                                                @foreach($defaulted_appoitment as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->file_no}}</td>
                                                        <td>  {{$result->full_name}}</td>
                                                        <td>  {{$result->phone_no}}</td>
                                                        <td>  {{$result->appntmnt_date}}</td>
                                                        <td>  {{$result->name}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                                    </tbody>
                                                </table>
                                            </div>



                                        </div>
                                    </div>
                                    <div class=" col-lg-6 col-sm-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <i class="icon-table"></i>LTFU Appointments
                                            </div>


                                            <div class="table-responsive">
                                                <table id="ltfu_table" class="display table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>UPN</th>
                                                            <th>Serial No</th>
                                                            <th>Client Name</th>
                                                            <th>Phone No</th>
                                                            <th>Appointment Date</th>
                                                            <th>Appointment Type</th>
                                                            <th>Other Appointment Type</th>
                                                            <th>No of Actions</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if (count($ltfu_appoitment) > 0)
                                                @foreach($ltfu_appoitment as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->file_no}}</td>
                                                        <td>  {{$result->full_name}}</td>
                                                        <td>  {{$result->phone_no}}</td>
                                                        <td>  {{$result->appntmnt_date}}</td>
                                                        <td>  {{$result->name}}</td>
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

        </div>
</div>

@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
 <script type="text/javascript">
   // multi column ordering
   $('#today_appointment_table').DataTable({
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
     // multi column ordering
   $('#missed_table').DataTable({
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
     // multi column ordering
   $('#defaulted_table').DataTable({
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
     // multi column ordering
   $('#ltfu_table').DataTable({
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
