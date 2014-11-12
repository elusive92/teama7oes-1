@extends('layout.main')

@section('title')
  @if($user)
  {{ e($user->username) }}
  @else
  404
  @endif
@stop

@section('content')

  <div id="profile">  
  @if($user)  
      <div id="profilebox">
          <div class="profilepic">
            @if($user->photo)
                {{ HTML::image('img/users/profile/'.$user->photo, '', ['width' => '150', 'height' => '150']) }}
            @else
                <a href="#"><img src="{{ URL::asset('/') }}img/default1.jpg" width="150" height="150" /></a>
              @endif
            @if(e($user->id ) == e(Auth::user()->id))
              <div class="clear"><a href="{{ URL::route('account-editprofile')}}" class="btn btn-default">Edit profile</a></div>
              <div class="clear"><a href="{{ URL::route('playerBlackList')}}" class="btn btn-default">Black List</a></div>
              <div class="clear"><a href="{{ URL::route('friendlistPlayer')}}" class="btn btn-default">Friend List</a></div>
            @else
              @if($friend)   <!-- tutaj chce sprawdzac czy friend juz jest -->
                <div class="clear"><a href="{{ URL::route('addFriendList', $user->username) }}" class="btn btn-default">Add friend</a></div>
              @endif
            @endif
          </div>
          
          <div class="data">
            <div class="nickname"><h1>{{ e($user->username) }}</h1></div>
            <p>From: {{ e($user->comefrom) }}</p>
            <p>Member since: {{ e($user->created_at) }}</p>
            <p>Games: </p>
            <p>Teams: </p>
          </div>
          <div class="sep"></div>

          <h3>About Me:</h3>
          <p>{{ e($user->about) }}</p>
      </div> 
    @else
    <h1>This user doesn't exists</h1>
    @endif     
  </div>

@stop