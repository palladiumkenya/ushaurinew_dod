@extends('layouts.master')
@section('page-css')

@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="row">



        <div id='calendar' class="calendar"></div>



        <div id="eventContent" title="Event Details" style="display:none;">
            Start: <span id="startTime"></span><br>
            End: <span id="endTime"></span><br><br>
            <p id="eventInfo"></p>
            <p><strong><a id="eventLink" href="" target="_blank">Read More</a></strong></p>
        </div>




    </div>
</div>
<!-- end of col -->

@endsection

@section('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.0/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.0/fullcalendar.min.css" />
<script type="text/javascript">

</script>


@endsection