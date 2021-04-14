@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Consent Client</div>
                            <form role="form" method="post"action="">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">CCC Number</label>
                                        <input type="text" class="form-control" id="firstName1" name="fname" placeholder="Enter CCC Number">
                                    </div>

                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection