<div class="container">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
          <li><a href="{{ URL::route('home')}}">Home</a></li>
          <li @if(Request::is('teams'))class="active"@endif><a href="{{ URL::route('teams')}}">Teams</a></li>
          <li @if(Request::is('tournaments'))class="active"@endif><a href="{{ URL::route('tournaments')}}">Tournaments</a></li>
          <li @if(Request::is('search'))class="active"@endif><a href="{{ URL::route('search')}}">Search</a></li>
          <li @if(Request::is('forum'))class="active"@endif><a href="{{ URL::route('forum')}}">Forum</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Games <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">League of Legends</a></li>
              <li><a href="#">CS:GO</a></li>
              <li class="divider"></li>
              <li><a href="#">WoT</a></li>
              <li><a href="#">CS 1.6</a></li>
              <li><a href="#">Fifa2014</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>