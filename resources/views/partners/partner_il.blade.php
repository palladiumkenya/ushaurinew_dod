@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                        <! <h4 class="card-title mb-3">List of Active IL Facilities</h4>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Partner Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($il_partners) > 0)
                                                @foreach($il_partners as $result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$result->partner}}</td>
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
            {
            extend: 'copy',
            title: 'List Of IL Facilities',
            filename: 'List Of IL Facilities'
            },
            {
            extend: 'csv',
            title: 'List Of IL Facilities',
            filename: 'List Of IL Facilities'
            },
            {
            extend: 'excel',
            title: 'List Of IL Facilities',
            filename: 'List Of IL Facilities'
            },
            {
            extend: 'pdf',
            title: 'List Of IL Facilities',
            filename: 'List Of IL Facilities'
            },
            {
            extend: 'print',
            title: 'List Of IL Facilities',
            filename: 'List Of IL Facilities'
            }
        ]
    });</script>


@endsection
