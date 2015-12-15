<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AQS Home</title>
        <!-- CSS  -->
            <!-- Custom -->
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/sb-admin.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/timeline.css') }}">

            <!-- MetisMenu CSS -->
            <link href="{{ URL::asset('../bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">
            
            <!-- theme -->
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/carousel.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.darkly.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/sb-admin.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/plugins/morris.css') }}">
            <!-- <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/custom.css') }}"> -->
            <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/app.css') }}">
            
    </head>
    <body>
        <div class="container">
            @include('layouts._nav') 
            @section('navbar')  
            @endsection
        </div>

        <div>
            <div class='mainContainer'> 
               <!--  Content!-->
                @section('content')
                    @yield('content')
                @show
            </div>
        </div>

        <!--  JavaScript  -->
        <script src="{{ URL::asset('bootstrap/js/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/moment.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/transition.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/collapse.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/bootstrap-datetimepicker.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/morris/raphael.min.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/morris/morris.min.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/morris/morris-data.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/morris/morris-data.js') }}"></script>
        
        <script src="{{ URL::asset('bootstrap/js/app.js') }}"></script>

        <ul class='custom-menu'>
          <li data-action="first">First thing</li>
          <li data-action="second">Second thing</li>
          <li data-action="third">Third thing</li>
        </ul>
    </body>
</html>