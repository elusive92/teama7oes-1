@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
  <div id="profile">

    
      <div id="userStats">
        <div class="profilepic">
          @if(Auth::user()->photo)
          <a href="#"><img src="{{ Auth::user()->photo }}" width="150" height="150" /></a>
          @else
          <a href="#"><img src="{{ URL::asset('/') }}img/default1.jpg" width="150" height="150" /></a>
          @endif
        </div>
        <div id="pright">
        <a href="{{ URL::route('account-editprofile')}}" class="btn btn-default">Edit profile</a>
        </div>
        <div class="data">
          <div  class="nickname"><h1>{{ Auth::user()->username }}</h1></div>
          <h5>From: </h5>
          <h5>Registered: </h5>
          <h5>Games: </h5>
          <h5>Teams: </h5>
        </div>
        <div class="sep"></div>

        <h3>About Me:</h3>
        <p>{{ Auth::user()->about }}</p>
      </div>
      
      
    
  </div>
@stop