@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
        @if (Auth::user()->access_level == 'Admin' || Auth::user()->access_level == 'Partner' || Auth::user()->access_level == 'Donor')
            <h4 class="card-title mb-3">My Facilities Lists</h4>
            @endif
            @if (Auth::user()->access_level == 'Facility')
            <h4 class="card-title mb-3">My Facility</h4>
            @endif
            <div class="col-md-12" style="margin-top:10px; ">


                <div class="table-responsive">
                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Facility Name</th>
                                <th>MFL Code</th>
                                <th>Facility Type</th>
                                <th>County</th>
                                <th>Sub County</th>
                                <th>Consituency</th>
                                <th>Owner</th>
                                <th>Approve</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facilities) > 0)
                            @foreach($facilities as $result)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td> {{$result->facility_name}}</td>
                                <td> {{$result->code}}</td>
                                <td> {{$result->facility_type}}</td>
                                <td> {{$result->county_name}}</td>
                                <td> {{$result->sub_county_name}}</td>
                                <td> {{$result->consituency_name}}</td>
                                <td> {{$result->owner}}</td>
                                @if($result->is_approved == 'Yes')
                                <td>{{$result->is_approved}}</td>
                                @else
                                <td>
                                    <button onclick="approvefacility({{$result}});" data-toggle="modal" data-target="#approvefacility" type="button" class="btn btn-primary btn-sm">Approve</button>
                                </td>
                                @endif
                                @if (Auth::user()->access_level == 'Admin' || Auth::user()->access_level == 'Partner')
                                <td>
                                    <button onclick="" data-toggle="modal" data-target="#" type="button" class="btn btn-primary btn-sm">Edit</button>
                                    <button onclick="" data-toggle="modal" data-target="#" type="button" class="btn btn-primary btn-sm">Delete</button>
                                </td>
                                @endif

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

<div id="approvefacility" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Facility?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Facility Name: <b>{{$result->facility_name}}</b> MFL Code: <b>{{$result->code}}</b></p>
            </div>
            <div class="modal-footer">
                <form role="form" method="post" action="{{route('approve-facility')}}">
                    {{ csrf_field() }}

                    <input type="hidden" name="mfl_code" id="mfl_code">
                    <button type="submit" class="btn btn-primary">Yes, Approve it!</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-js')

<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script type="text/javascript">
    function approvefacility(result) {
        $('#mfl_code').val(result.code);
    }
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
        "responsive": true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


@endsection