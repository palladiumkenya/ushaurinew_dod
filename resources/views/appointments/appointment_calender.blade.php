@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

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


<script type="text/javascript">

$(document).ready(function () {


   $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   var calendar = $('#calendar').fullCalendar();
});

</script>


@endsection