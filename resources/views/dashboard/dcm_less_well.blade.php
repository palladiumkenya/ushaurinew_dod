@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                        <h4 class="card-title mb-3">{{count($all_clients_duration_less_well)}} Clients </h4>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                   
                </div>
                          
                          
                           
                            
                            <div class="table-responsive">                                    
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>CCC Number</th>
                                                <th>Status</th>
                                                <th>Stability Status</th>
                                                <th>Refill Date</th>
                                                <th>Clinical Review Date</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_clients_duration_less_well) > 0)
                                                @foreach($all_clients_duration_less_well as $clients)
                                                    <tr> 
                                                       
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

                <div id="editFacility" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                        
                        <div class="card-title mb-3">Edit facility</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form role="form" method="post"action="{{route('get_dcm_less_well')}}">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Facility Name</label>
                                        <input type="text" class="form-control"  readonly id="name" name="name" >
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lastName1">MFL Code</label>
                                        <input type="text" class="form-control" readonly id="code" name="code" >
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">County</label>
                                        <input type="text" class="form-control" readonly id="county" name="county" >
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone">Sub-County</label>
                                        <input class="form-control" id="subcounty" readonly name="subcounty" >
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone">Phone Number</label>
                                        <input class="form-control" id="phone" name="phone" >
                                    </div>

                                 
                        
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>

                    </div>
                </div>

                <div id="RemoveModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Remove Facility</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to remove this Facility?</p>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                            <button id="remove" type="button" class="btn btn-danger" >Remove</button>
                        </div>
                        <div class="modal-footer">
                        
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>


@endsection

@section('page-js')

<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script>

<script type="text/javascript">

function editFacility(facility){

    console.log(facility);

 
}



function removeFacility(id){
    $('#RemoveModal').modal('show');

    $(document).off("click", "#remove").on("click", "#remove", function (event) {
        $.ajax({
          
            }
        })
    });

}

</script>


@endsection
