@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">

            <div style="margin-bottom:10px; ">
                <a type="button" href="{{route('admin-users-form')}}" class="btn btn-primary btn-md pull-right">Add User</a>
            </div>
            <div class="table-responsive">
                <table id="multicolumn_ordering_table" class="display table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                        <th>No.</th>
                            <th>User Name</th>
                            <th>DOB</th>
                            <th>Phone No</th>
                            <th>Email</th>
                            <th>Access Level</th>
                                <th>Clinic Name</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Time Stamp</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_users) > 0)
                        @foreach($all_users as $user)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            <td> {{$user->user_name}}</td>
                            <td> {{$user->dob}}</td>
                            <td> {{$user->phone_no}}</td>
                            <td> {{$user->e_mail}}</td>
                            <td> {{$user->access_level}}</td>
                            <td> {{$user->clinic_name}}</td>
                            <td> {{$user->status}}</td>
                            <td> {{$user->created_at}}</td>
                            <td> {{$user->updated_at}}</td>
                                <td>
                                    <button onclick="editUser({{$user}});" data-toggle="modal" data-target="#editUser"
                                        type="button" class="btn btn-primary btn-sm">Edit</button>
                                        <button onclick="deleteUser({{$user->id}});" type="button"
                                        class="btn btn-danger btn-sm">Delete</button>
                                    <button onclick="resetUser({{$user->id}});" type="button"
                                        class="btn btn-success btn-sm">Reset Pass</button>


                                </td>
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
<!-- edit goes here -->


<div id="ResetModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reset this user's password?.</p>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button id="reset" type="button" class="btn btn-success" data-person_id="">Reset</button>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="DeleteModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Delete this user's password?.</p>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button id="delete" type="button" class="btn btn-danger" data-person_id="">Delete</button>
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
<script type="text/javascript">

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