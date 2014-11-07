@extends('layout.main')

@section('title')
	User search
@stop

@section('content')
	{{--cala podstrona do skasowania--}}
 <div id="teams">
 	<form action="{{ URL::route('team-searchTeam') }}" files="true" method="post" >

	<div class="form-group">
            <label for="name">Username:</label> <input type="text" name="name" class="form-control" id="name" placeholder="username"/>
        </div>
        @if($errors->has('name'))
        <p class='error'>{{ $errors->first('name') }}</p>
        @endif

 	 <input type="submit" value="Search" class="btn btn-default"/>
	{{ Form::token() }}
    </form>  
  </div>	

@stop