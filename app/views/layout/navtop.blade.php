<script src="js/popup.js"></script>

<ul id="nav">

	<a href="{{ URL::route('home')}}"><img class="logo" src="{{ URL::asset('/') }}img/nav_logo.png" alt="Tema7oes" height="30" width="115"></a>
	@if(Auth::check())
	
    <!--<li><a href="{{ URL::route('account-sign-out') }}">Log out <img src="{{ URL::asset('/') }}img/ico/log_out.png"  width="21" height="18" /></a></li>
    -->
    <!--<li><a href="{{ URL::route('userprofile', Auth::user()->username) }}">{{ Auth::user()->username }}</a></li>
    -->
    <li>
    <div class="dropdown">
      <button id="navtop-button" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        {{ Auth::user()->username }}
        <span class="caret"></span>
      </button>
      <ul id="navtop-ul" class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu3">
        <li role="menuitem"><a href="{{ URL::route('userprofile', Auth::user()->username) }}">My profile</a></li>
        <li role="menuitem"><a href="{{ URL::route('account-editprofile')}}">Edit profile</a></li>
        <li role="menuitem"><a href="{{ URL::route('getInbox')}}">Messages</a></li>
        <li role="menuitem"><a href="{{ URL::route('friendlistPlayer')}}">Friend list</a></li>
        <li role="menuitem"><a href="{{ URL::route('playerBlackList')}}">Black list</a></li>
        <li role="menuitem"><a href="{{ URL::route('account-sign-out') }}">Log out</a></li>
      </ul>
      </div>
    </li>
        @if(Auth::user()->photo)
        <li><img src="{{ Auth::user()->photo }}" width="30" height="30" /></li>
        @else 
        <li><img src="{{ URL::asset('/') }}img/default1.jpg" width="30" height="30" /></li>
        @endif
        <!--<li><a href="#"><img class="message" src="{{ URL::asset('/') }}img/ico/message.png"></a></li>
        -->
	
    @else
    <li><a href="#" class="topopup2">Register</a></li>
    <li><a href="#" class="topopup">Login</a></li>
    @endif
</ul>