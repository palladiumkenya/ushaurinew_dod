@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')
<div class="breadcrumb">
                <ul>
                    <li><a href="">Active Facilities</a></li>
                    <li></li>
                </ul>
            </div>

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                         <h4 class="card-title mb-3">List of Active Facilities</h4>
                            <div class="col-md-12" style="margin-top:10px; ">


                                <div class="table-responsive">
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Facility Name</th>
                                                <th>Mfl Code</th>
                                                <th>Number Of Clients</th>
                                                <th>Partner</th>
                                                <th>County</th>
                                                <th>Subcounty</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_active_facilities) > 0)
                                                @foreach($all_active_facilities as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->facility}}</td>
                                                        <td>  {{$result->mfl_code}}</td>
                                                        <td>  {{$result->actual_clients}}</td>
                                                        <td>  {{$result->partner}}</td>
                                                        <td>  {{$result->county}}</td>
                                                        <td>  {{$result->sub_county}}</td>
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
            {
            extend: 'copy',
            title: 'Active Facilities',
            filename: 'Active Facilities'
            },
            {
            extend: 'csv',
            title: 'Active Facilities',
            filename: 'Active Facilities'
            },
            {
            extend: 'excel',
            title: 'Active Facilities',
            filename: 'Active Facilities'
            },
            {
            extend: 'pdf',
            title: 'Active Facilities',
            filename: 'Active Facilities'
            },
            {
            extend: 'print',
            title: 'Active Facilities',
            filename: 'Active Facilities'
            }
        ]
    });</script>


@endsection
