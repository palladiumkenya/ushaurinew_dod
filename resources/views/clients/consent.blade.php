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

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="middleName1">Middle name</label>
                                        <input type="text" class="form-control" id="middleName1" name="mname" placeholder="Enter your middle name">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lastName1">Last name</label>
                                        <input type="text" class="form-control" id="lastName1" name="lname" placeholder="Enter your last name">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" required="" name="e_mail" class=" input-rounded input-sm form-control e_mail" placeholder="Enter your Email" />
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone">Phone No</label>
                                        <input type="text" required="" name="phone_no" pattern="^(([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+$" placeholder="Phone No should be 10 Digits " id="phone_no" class="input-rounded input-sm form-control phone_no" />
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lastName1">Acess Level</label>
                                        <select  class="form-control" data-width="100%" id="county" name="county_id">

                                        </select>
                                    </div>

                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection