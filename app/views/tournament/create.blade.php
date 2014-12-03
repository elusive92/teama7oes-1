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
            <label for="tournamentname">Tournament name:</label> <input type="text" pattern=".{3,}" name="tournamentname" class="form-control" id="tournamentname" placeholder="Tournament name" {{ (Input::old('tournamentname')) ? 'value="' . e(Input::old('tournamentname')) . '"' : '' }}/>
        </div>

        <div class="form-group">
            <label for="descript">Full description here:</label> <input type="text" name="descript" class="form-control" id="descript" placeholder="description"/>
        </div>

        <div class="form-group">
            <label for="numberofteams">Number of teams:</label> <input type="number" min="8" pattern="[0-9]" name="numberofteams" class="form-control" id="numberofteams" placeholder="number of teams"/>
        </div>

        <div class="form-group">
            <label for="numberofplayer">Team number of players:</label> <input type="number" pattern="[0-9]" name="numberofplayers" class="form-control" id="numberofplayers" placeholder="number of players"/>
        </div>

        <div class="form-group">
            <label for="dateEnd">Koniec rejestracji:</label> <input type="date" name="dateEnd" class="form-control" id="dateEnd" placeholder="rrrr-mm-dd"/>
        </div>

        <div class="form-group">
            <label for="dateStart">Data turnieju:</label> <input type="date" name="dateStart" class="form-control" id="dateStart" placeholder="rrrr-mm-dd"/>
        </div>

        <div class="form-group">
            <label for="gameid"></label> <input type="hidden"  name="gameid" class="form-control" value="{{Cookie::get('gameid')}}" id="gameid"/>
        </div>

        <input type="submit" value="Create" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>
@stop