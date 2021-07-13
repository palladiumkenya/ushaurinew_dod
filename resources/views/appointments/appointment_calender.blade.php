@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="row">



        <div id='calendar' class="calendar"></div>



        <div id="eventContent" title="Event Details" style="display:none;">
        {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
        </div>


    </div>
</div>
<!-- end of col -->

@endsection

@section('page-js')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>
<script type="text/javascript">

</script>


@endsection