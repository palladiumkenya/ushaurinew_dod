@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">

@endsection
@section('main-content')

<div class="breadcrumb">
                <ul>
                    <li><a href="">HEIs Final Outcome</a></li>
                    <li></li>
                </ul>
            </div>


            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card mb-4">
                    <div class="panel-heading">
                      <i class="icon-table">{{count($all_deceased_heis)}} Deceased HEIs List</i>
                     </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                                <table id="hei_deceased_table" class="display table table-striped table-bordered" style="width:50%">
                                                <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Clinic Number</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Hei Number</th>
                                                <th>Phone No</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_deceased_heis) > 0)
                                                @foreach($all_deceased_heis as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->f_name}}</td>
                                                        <td>  {{$result->m_name}}</td>
                                                        <td>  {{$result->l_name}}</td>
                                                        <td>  {{$result->hei_no}}</td>
                                                        <td>  {{$result->phone_no}}</td>

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
                         <i class="icon-table">{{count($all_transfer_heis)}} Transfer Out HEIs List</i>
                          </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                                <table id="hei_transfer_table" class="display table table-striped table-bordered" style="width:50%">
                                                <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Clinic Number</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Hei Number</th>
                                                <th>Phone No</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_transfer_heis) > 0)
                                                @foreach($all_transfer_heis as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->f_name}}</td>
                                                        <td>  {{$result->m_name}}</td>
                                                        <td>  {{$result->l_name}}</td>
                                                        <td>  {{$result->hei_no}}</td>
                                                        <td>  {{$result->phone_no}}</td>

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
                      <i class="icon-table">{{count($all_discharged_heis)}} Discharged HEIs List</i>
                     </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                                <table id="hei_discharged_table" class="display table table-striped table-bordered" style="width:50%">
                                                <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Clinic Number</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Hei Number</th>
                                                <th>Phone No</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_discharged_heis) > 0)
                                                @foreach($all_discharged_heis as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->clinic_number}}</td>
                                                        <td>  {{$result->f_name}}</td>
                                                        <td>  {{$result->m_name}}</td>
                                                        <td>  {{$result->l_name}}</td>
                                                        <td>  {{$result->hei_no}}</td>
                                                        <td>  {{$result->phone_no}}</td>

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
     



@endsection

@section('page-js')


     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"> </script>
     <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>

     <script type="text/javascript">

$('#hei_discharged_table').DataTable({
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
            title: 'Discharged HEIs List',
            filename: 'Discharged HEIs List'
            },
            {
            extend: 'csv',
            title: 'Discharged HEIs List',
            filename: 'Discharged HEIs List'
            },
            {
            extend: 'excel',
            title: 'Discharged HEIs List',
            filename: 'Discharged HEIs List'
            },
            {
            extend: 'pdf',
            title: 'Discharged HEIs List',
            filename: 'Discharged HEIs List'
            },
            {
            extend: 'print',
            title: 'Discharged HEIs List',
            filename: 'Discharged HEIs List'
            }
        ]
    });
    $('#hei_deceased_table').DataTable({
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
            title: 'Deceased HEIs List',
            filename: 'Deceased HEIs List'
            },
            {
            extend: 'csv',
            title: 'Deceased HEIs List',
            filename: 'Deceased HEIs List'
            },
            {
            extend: 'excel',
            title: 'Deceased HEIs List',
            filename: 'Deceased HEIs List'
            },
            {
            extend: 'pdf',
            title: 'Deceased HEIs List',
            filename: 'Deceased HEIs List'
            },
            {
            extend: 'print',
            title: 'Deceased HEIs List',
            filename: 'Deceased HEIs List'
            }
        ]
    });
    $('#hei_transfer_table').DataTable({
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
            title: 'Transfer Out HEIs List',
            filename: 'Transfer Out HEIs List'
            },
            {
            extend: 'csv',
            title: 'Transfer Out HEIs List',
            filename: 'Transfer Out HEIs List'
            },
            {
            extend: 'excel',
            title: 'Transfer Out HEIs List',
            filename: 'Transfer Out HEIs List'
            },
            {
            extend: 'pdf',
            title: 'Transfer Out HEIs List',
            filename: 'Transfer Out HEIs List'
            },
            {
            extend: 'print',
            title: 'Transfer Out HEIs List',
            filename: 'Transfer Out HEIs List'
            }
        ]
    });
     // multi column ordering

        </script>

@endsection
