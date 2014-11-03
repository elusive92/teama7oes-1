@extends('layout.main')

@section('title')

@stop

@section('content')

 <div id="teams">
 	<form action="{{ URL::route('team-searchTeam') }}" files="true" method="post" >

	<div class="form-group">
            <label for="name">name:</label> <input type="text" name="name" class="form-control" id="name" placeholder="name"/>
        </div>
        @if($errors->has('name'))
        <p class='error'>{{ $errors->first('name') }}</p>
        @endif

 	 <input type="submit" value="Search" class="btn btn-default"/>
	{{ Form::token() }}
    </form>  
  </div>	

@stop