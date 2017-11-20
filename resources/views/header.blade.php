@section('header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rolem Logistics Portal</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.print.css" media="print">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset("vendor/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo asset("vendor/css/mdb.min.css"); ?>" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo asset("vendor/css/style.css"); ?>" rel="stylesheet">
    <!-- JQuery -->
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
   crossorigin="anonymous">
    </script>
    <script
    src="http://momentjs.com/downloads/moment.js">
    </script>
<!-- Calendar -->
<script>
$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
      views: {
        month: { // name of view
            titleFormat: 'DD.MM.YYYY'
            // other view-specific options here
        }
    }, eventSources: [

        // your event source
        {
            events: [ // put the array in the `events` property
                {
                    title  : 'event1',
                    start  : '2017-11-01'
                },
                {
                    title  : 'event2',
                    start  : '2017-11-06',
                    end    : '2017-11-07'
                },
                {
                    title  : 'event3',
                    start  : '2010-01-09T12:30:00',
                }
            ],
        }

        // any other event sources...

    ]
    });

});
</script>
  
</head>
@show
