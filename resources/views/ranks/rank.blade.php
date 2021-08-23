@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
            <h4 class="card-title mb-3">A list of Ranks in the system</h4>
            <div class="col-md-12" style="margin-bottom:20px;">
                <a type="button" href="" data-toggle="modal" data-target="#addrank" class="btn btn-primary btn-md pull-right">Add Rank</a>

            </div>
            <div class="table-responsive">
                <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Rank Name</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Time Stamp</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_rank) > 0)
                        @foreach($all_rank as $rank)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            <td> {{$rank->rank_name}}</td>
                            <td> {{$rank->status}}</td>
                            <td> {{$rank->created_at}}</td>
                            <td> {{$rank->updated_at}}</td>
                            <td>
                                <button onclick="editrank({{ $rank }});" data-toggle="modal" data-target="#editrank" type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button onclick="deleterank({{ $rank->id }});" data-toggle="modal" data-target="#deleterank" type="button" class="btn btn-primary btn-sm">Delete</button>
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
<div id="addrank" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <div class="card-title mb-3">Add Rank</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form role="form" method="post" action="{{route('addranks')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Rank Name</label>
                                        <input type="text" class="form-control" id="rank_name" name="rank_name" placeholder="Rank Name" />
                                    </div>
                                    <div class="col-md-6 form-group mb-3" id="add_status_div">
                                        <label>Status : </label>
                                        <select name="status" class="form-control status" id="status" name="status">
                                            <option value="">Please select</option>
                                            <option value="Active">Active</option>
                                            <option value="Disabled">Disabled</option>
                                        </select>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Add Rank</button>
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

<!-- end of col -->
<div id="editrank" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <div class="card-title mb-3">Edit Rank</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">

                            <form role="form" method="post" action="{{route('editranks')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Rank Name</label>
                                        <input type="text" class="form-control" id="rank_name" name="rank_name" placeholder="Rank name">
                                    </div>
                                    <div class="col-md-6 form-group mb-3" id="add_status_div">
                                        <label>Status : </label>
                                        <select name="status" class="form-control status" id="status" name="status">
                                            <option value="">Please select</option>
                                            <option value="Active">Active</option>
                                            <option value="Disabled">Disabled</option>
                                        </select>
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

<div id="deleterank" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Rank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Rank?</p>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button id="delete" type="button" class="btn btn-danger">Delete</button>
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

    function editrank(rank) {

        $('#rank_name').val(rank.rank_name);
        $('#id').val(rank.id);
    }

    function deleterank(id) {
        $('#deleterank').modal('show');
        console.log(id);
        $(document).off("click", "#delete").on("click", "#delete", function(event) {
            $.ajax({
                type: "POST",
                url: '/delete/rank',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token()}}"
                },
                dataType: "json",
                success: function(data) {
                    toastr.success(data.details);
                    $('#deleterank').modal('hide');
                }
            })
        });
    }
</script>


@endsection