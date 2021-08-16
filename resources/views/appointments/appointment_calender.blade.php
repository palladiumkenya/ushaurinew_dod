@extends('layouts.master')
@section('page-css')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

@endsection

@section('main-content')
<div class="breadcrumb">
                <ul>
                    <li><a href="">Appointment Calender</a></li>
                    <li></li>
                </ul>
            </div>

<div class="col-md-12 mb-4">
    <div class="row">



        <div id='calendar'></div>



    </div>
</div>
<!-- end of col -->

@endsection

@section('page-js')

<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>


<script type="text/javascript">

$(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            initialView: 'dayGridMonth',
            eventColor: 'green',
            events : [
                @foreach($app_calendar_data as $appointment)
                {
                    title : '{{ $appointment->app_type }}',
                    start : '{{ $appointment->app_date }}',
                    color: 'purple'

                },
                @endforeach
            ],
        });

    });
</script>


@endsection