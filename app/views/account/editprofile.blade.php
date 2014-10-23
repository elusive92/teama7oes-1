@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
  <div id="profile">

    
      <div id="userStats">
        <div class="profilepic">
          
        </div>
        <div id="pright">
        </div>
        <div class="data">
         
        {{--  {{ Form::model($user, array('route' => array('user.update', $user->id)))}}
             
         {{--  {{ Form::close() }} --}}
        <div class="sep"></div>
      </div>
      
      
    
  </div>
@stop