@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
  <div id="profile">

    
      <div id="userStats">
        <div class="profilepic">
          <a href="#"><img src="{{ Auth::user()->photo }}" width="150" height="150" /></a>
        </div>
        <div id="pright">
        <button type="button" class="btn btn-default">Edit profile</button>
        <a href="{{ URL::route('account-editprofile')}}">Edit profile</a>
        </div>
        <div class="data">
          <div  class="nickname"><h1>{{ Auth::user()->username }}</h1></div>
          <h5>From: (kraj, moze flaga?)</h5>
          <h5>Registered: </h5>
          <h5>Games: <input id="DodawanieGier" type="button" value="dodaj gre" /></h5>
          <h5>Teams: <input id="StworzTeam" type="button" value="stworz team" /></h5>
          <h5>tematy na forum, posty? </h5>

        </div>
        <div class="sep"></div>

        <h3>About Me:</h3>
        <p>{{ Auth::user()->about }}</p>
      </div>
      
      
    
  </div>
@stop