@extends('layout.main')

@section('title')
  Create Team
@stop

@section('content')
 @if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
 @endif
 
<div class='form'>
    <form action="{{ URL::route('tournament-create-post') }}" method="post">

        <div class="form-group">
            <label for="tournamentname">Tournament name:</label> <input type="text" name="tournamentname" class="form-control" id="tournamentname" placeholder="Tournament name" {{ (Input::old('tournamentname')) ? 'value="' . e(Input::old('tournamentname')) . '"' : '' }}/>
        </div>
        @if($errors->has('tournamentname'))
        <p class='error'>{{ $errors->first('tournamentname') }}</p>
        @endif

        <div class="form-group">
            <label for="descript">Full description here:</label> <input type="text" name="descript" class="form-control" id="descript" placeholder="description"/>
        </div>
        @if($errors->has('descript'))
        <p class='error'>{{ $errors->first('descript') }}</p>
        @endif 

        <div class="form-group">
            <label for="numberofteams">Number of teams:</label> <input type="number" name="numberofteams" class="form-control" id="numberofteams" placeholder="number of teams"/>
        </div>
        @if($errors->has('numberofteams'))
        <p class='error'>{{ $errors->first('numberofteams') }}</p>
        @endif

        <div class="form-group">
            <label for="numberofplayer">Min number of players:</label> <input type="number" name="numberofplayers" class="form-control" id="numberofplayers" placeholder="number of players"/>
        </div>
        @if($errors->has('numberofplayers'))
        <p class='error'>{{ $errors->first('numberofplayers') }}</p>
        @endif


        <input type="submit" value="Create" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>
@stop