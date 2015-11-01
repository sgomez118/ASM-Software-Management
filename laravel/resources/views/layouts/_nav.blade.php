@section('navbar')
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">AQS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/students">Students</a></li>
            <li><a href="/professors">Professors</a></li>
            <li><a href="/chairs">Chairs</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/login">Log in</a></li>
            <li><a href="/register">Register</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

@show