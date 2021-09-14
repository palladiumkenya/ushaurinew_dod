@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')
<div class="breadcrumb">
    <ul>
        <li><a href="">Messages Extract</a></li>
        <li></li>
    </ul>
</div>

@if (Auth::user()->access_level == 'Admin' || Auth::user()->access_level == 'Partner' || Auth::user()->access_level == 'Donor')


<div class="col-md-12">

    <form role="form" method="post" action="#" id="dataFilter">
        {{ csrf_field() }}
        <div class="row">
            <div class="col">
                <div class="form-group">

                    <select class="form-control filter_partner  input-rounded input-sm select2" id="partners" name="partner">
                        <option value="">Please select Service</option>
                        @foreach ($all_partners as $partner => $value)
                        <option value="{{ $partner }}"> {{ $value }}</option>
                        @endforeach

                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <select class="form-control county  input-rounded input-sm select2" id="counties" name="county">
                        <option value="">Please select Unit:</option>
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <span class="filter_facility_wait" style="display: none;">Loading , Please Wait ...</span>

                    <select class="form-control filter_facility input-rounded input-sm select2" id="facilities" name="facility">
                        <option value="">Please select Facility : </option>
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                    <button class="btn btn-default filter btn-round  btn-small btn-primary  " type="submit" name="filter" id="filter"> <i class="fa fa-filter"></i>
                        Filter</button>
                </div>
            </div>
        </div>

    </form>

</div>
@endif

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
            <! <h4 class="card-title mb-3">{{count($message_extract)}} Messages Extract List</h4>
                <div class="col-md-12" style="margin-top:10px; ">

                </div>
                <div class="table-responsive">
                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>KDOD Number</th>
                                <th>Gender</th>
                                <th>Group</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Text Time</th>
                                <th>Language</th>
                                <th>Message Type</th>
                                <th>Message Month Year</th>
                                <th>Message</th>
                                <th>Service</th>
                                <th>Unit</th>
                                <th>MFL Code</th>
                                <th>Facility</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($message_extract) > 0)
                            @foreach($message_extract as $message)
                            <tr>
                                <td> {{ $message->clinic_number }}</td>
                                <td> {{$message->gender}}</td>
                                <td> {{$message->group_name}}</td>
                                <td> {{$message->Gender}}</td>
                                <td> {{$message->marital}}</td>
                                <td> {{$message->preferred_time}}</td>
                                <td> {{$message->language}}</td>
                                <td> {{$message->message_type}}</td>
                                <td> {{$message->month_year}}</td>
                                <td> {{$message->msg}}</td>
                                <td> {{$message->partner_name}}</td>
                                <td> {{$message->county}}</td>
                                <td> {{$message->mfl_code}}</td>
                                <td> {{$message->facility_name}}</td>
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
    $(document).ready(function() {
        $('select[name="partner"]').on('change', function() {
            var partnerID = $(this).val();
            if (partnerID) {
                $.ajax({
                    url: '/get_dashboard_units/' + partnerID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {


                        $('select[name="county"]').empty();
                        $('select[name="county"]').append('<option value="">Please Unit</option>');
                        $.each(data, function(key, value) {
                            $('select[name="county"]').append('<option value="' + key + '">' + value + '</option>');
                        });


                    }
                });
            } else {
                $('select[name="county"]').empty();
            }
        });
    });


    $(document).ready(function() {
        $('select[name="county"]').on('change', function() {
            var countyID = $(this).val();
            if (countyID) {
                $.ajax({
                    url: '/get_dashboard_facilities/' + countyID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('select[name="facility"]').empty();
                        $('select[name="facility"]').append('<option value="">Please Select Facility</option>');
                        $.each(data, function(key, value) {
                            $('select[name="facility"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    }
                });
            } else {
                $('select[name="facility"]').empty();
            }
        });
    });
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
        buttons: [{
                extend: 'copy',
                title: 'Messages Extract List',
                filename: 'Messages Extract List'
            },
            {
                extend: 'csv',
                title: 'Messages Extract List',
                filename: 'Messages Extract List'
            },
            {
                extend: 'excel',
                title: 'Messages Extract List',
                filename: 'Messages Extract List'
            },
            {
                extend: 'pdf',
                title: 'Messages Extract List',
                filename: 'Messages Extract List'
            },
            {
                extend: 'print',
                title: 'Messages Extract List',
                filename: 'Messages Extract List'
            }
        ]
    });
</script>


@endsection