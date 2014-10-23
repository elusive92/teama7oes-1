<script src="js/popup.js"></script>

<ul id="nav">
	<img class="logo" src="{{ URL::asset('/') }}img/nav_logo.png" alt="Tema7oes" height="25" width="160">
	@if(Auth::check())

    <li><a href="{{ URL::route('account-sign-out') }}">Log out</a></li>
    <li><a href="{{ URL::route('account-profile') }}">{{ Auth::user()->username }}</a></li>
	@else
    <li><a href="#" class="topopup2">Register</a></li>
    <li><a href="#" class="topopup">Login</a></li>
    @endif
</ul>