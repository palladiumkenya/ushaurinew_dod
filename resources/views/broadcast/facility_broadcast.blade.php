@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3 text-center">New Broadcast</div>
                            <form role="form" method="post"action="{{route('send-broadcast')}}">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-12 form-group mb-3">
                                        <select class="form-control" data-width="100%" id="mfl_code" name="mfl_code" data-actions-box="true">
                                            <option value="">Select Facility</option>
                                                @if (count($facilities) > 0)
                                                    @foreach($facilities as $facility)
                                                    <option value="{{$facility->code }}">{{ ucwords($facility->name) }}</option>
                                                        @endforeach
                                                @endif
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <select class="form-control" data-width="100%" id="groups" name="groups" data-actions-box="true">
                                            <option value="">Select Group</option>
                                                @if (count($groups) > 0)
                                                    @foreach($groups as $group)
                                                    <option value="{{$group->id }}">{{ ucwords($group->name) }}</option>
                                                        @endforeach
                                                @endif
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <select class="form-control" data-width="100%" id="genders" name="genders" data-actions-box="true">
                                            <option value="">Select Gender</option>
                                                @if (count($genders) > 0)
                                                    @foreach($genders as $gender)
                                                    <option value="{{$gender->id }}">{{ ucwords($gender->name) }}</option>
                                                        @endforeach
                                                @endif
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" rows="3" id="message" name="message" placeholder="message"> </textarea>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection