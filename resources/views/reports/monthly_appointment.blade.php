@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
            <! <h4 class="card-title mb-3">Monthly Appointment Summary Report</h4>
                <div class="col-md-12" style="margin-top:10px; ">

                </div>
                <div class="table-responsive">
                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Label:</th>
                                <th>Partner</th>
                                <th>County</th>
                                <th>Sub County</th>
                                <th>MFL Code</th>
                                <th>Facility Name</th>
                                <th>Month Year</th>
                                <th>0-9</th>
                                <th>10-14</th>
                                <th>15-19</th>
                                <th>20-14</th>
                                <th>25+</th>
                                <th>Total Female</th>
                                <th>Total Male</th>
                                <th>Total Transgender</th>
                                <th>Total Not Provided</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($monthly_app_summary) > 0)
                            @foreach($monthly_app_summary as $result)
                            <tr>
                                <td> {{$result->label}}</td>
                                <td> {{$result->partner}}</td>
                                <td> {{$result->county}}</td>
                                <td> {{$result->sub_county}}</td>
                                <td> {{$result->mfl_code}}</td>
                                <td> {{$result->facility_name}}</td>
                                <td> {{$result->time}}</td>
                                <td> {{$result->ToNine}}</td>
                                <td> {{$result->ToFourteen}}</td>
                                <td> {{$result->ToNineteen}}</td>
                                <td> {{$result->ToTwentyFour}}</td>
                                <td> {{$result->PlusTwentyFive}}</td>
                                <td> {{$result->Total_Female}}</td>
                                <td> {{$result->Total_Male}}</td>
                                <td> {{$result->Total_Transgender}}</td>
                                <td> {{$result->Total_Not_Provided}}</td>
                                <td> {{$result->TOTAL}}</td>
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