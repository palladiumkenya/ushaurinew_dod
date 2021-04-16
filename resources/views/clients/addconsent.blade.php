@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Consent Client</div>
                            <form role="form" method="post"action="{{route('report-clients-consent')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="number">CCC Number</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="CCC Number">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection