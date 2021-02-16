@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                        <! <h4 class="card-title mb-3">Scheduled Heis List</h4>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Clinic Number</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Hei Number</th>
                                                <th>Phone No</th>
                                                <th>Visit Type</th>
                                                <th>Appointment Date</th>
                                                <th>Appoitment Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_scheduled_heis) > 0)
                                                @foreach($all_scheduled_heis as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->f_name}}</td>
                                                        <td>  {{$result->m_name}}</td>
                                                        <td>  {{$result->l_name}}</td>
                                                        <td>  {{$result->hei_no}}</td>
                                                        <td>  {{$result->phone_no}}</td>
                                                        <td>  {{$result->visit_type}}</td>
                                                        <td>  {{$result->appntmnt_date}}</td>
                                                        <td>  {{$result->app_type_1}}</td>
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
