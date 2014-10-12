<ul class="nav nav-pills">
    <li @if(Request::is('/'))class="active"@endif><a href="{{ URL::route('home')}}">Home</a></li>
    <li @if(Request::is('search'))class="active"@endif><a href="{{ URL::route('search')}}">Search</a></li>
    <li @if(Request::is('rank'))class="active"@endif><a href="{{ URL::route('rank')}}">Ranking</a></li>
    @if(Auth::check())    
    <li @if(Request::is('tournaments'))class="active"@endif><a href="{{ URL::route('tournaments')}}">Tournaments</a></li>
    <li @if(Request::is('team'))class="active"@endif><a href="{{ URL::route('team')}}">Team</a></li>    
    <li @if(Request::is('profile'))class="active"@endif><a href="{{ URL::route('profile')}}">Profile: {{ Auth::user()->username }}</a></li>
    <li @if(Request::is('pm'))class="active"@endif><a href="{{ URL::route('pm')}}">PM</a></li>    
    <li><a href="{{ URL::route('account-sign-out') }}">Log out</a></li>
    @else
    <li><a href="#" class="topopup">Log in</a></li>
    <li><a href="#" class="topopup2">Registration</a></li>
    @endif
</ul>