@section('navbar')
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand active" href="#">AQS</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home <span class="sr-only">(current)</span></a></li>
                    @if(Auth::check())
                        @if(Auth::user()->type == 'student')
                            <li class="active"><a href="/dashboard">Student Dashboard</a></li>
                        @elseif(Auth::user()->type == 'lecturer')
                            <li class="active"><a href="/dashboard">Professor Dashboard</a></li>
                            <li><a href="/question">View Questions</a></li>
                            <li><a href="/student">Register Students</a></li>
                        @elseif(Auth::user()->type == 'chair')
                            <li class="active"><a href="/dashboard">Chair Dashboard</a></li>
                        @endif
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li><a href="/logout">Log Out</a></li>
                        @if(Auth::user()->type == 'chair')
                            <li><a href="/register"> or Register?</a></li>
                        @endif
                    @else
                        <li><a href="/login">Log in</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@show