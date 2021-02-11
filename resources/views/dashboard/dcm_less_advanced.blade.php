@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                        <h4 class="card-title mb-3">{{count($all_clients_duration_less_advanced)}} Clients </h4>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                   
                </div>
                          
                          
                           
                            
                            <div class="table-responsive">                                    
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>CCC Number</th>
                                                <th>Status</th>
                                                <th>Stability Status</th>
                                                <th>Refill Date</th>
                                                <th>Clinical Review Date</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_clients_duration_less_advanced) > 0)
                                                @foreach($all_clients_duration_less_advanced as $clients)
                                                    <tr> 
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td> {{ ucwords($clients->clinic_number)}}</td>
                                                        <td>  {{$clients->status_two}}</td>
                                                        <td>  {{$clients->stability_status}}</td>
                                                        <td>  {{$clients->refill_date}}</td>
                                                        <td>  {{$clients->clinical_visit_date}}</td>
                                                       
                                                       
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
    });

</script>


@endsection
