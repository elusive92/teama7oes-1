<script src="js/popup.js"></script>

<ul id="nav">
	<a href="{{ URL::route('home')}}"><img class="logo" src="{{ URL::asset('/') }}img/nav_logo.png" alt="Tema7oes" height="30" width="165"></a>
	@if(Auth::check())
	
    <li><a href="{{ URL::route('account-sign-out') }}">Log out</a></li>
    <li><a href="{{ URL::route('account-profile') }}">{{ Auth::user()->username }}</a></li>

        @if(Auth::user()->photo)
        <li><img src="{{ Auth::user()->photo }}" width="30" height="30" /></li>
        @else 
        <li><img src="{{ URL::asset('/') }}img/default1.jpg" width="30" height="30" /></li>
        @endif
	
    @else
    <li><a href="#" class="topopup2">Register</a></li>
    <li><a href="#" class="topopup">Login</a></li>
    @endif
</ul>