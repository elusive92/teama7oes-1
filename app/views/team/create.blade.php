@extends('layout.main')

@section('content')
<div class='form'>
    <form action="{{ URL::route('team-create-post') }}" method="post">

        <div class="form-group">
            <label for="Teamname">Team name:</label> <input type="text" name="teamname" class="form-control" id="Teamname" placeholder="Team name" {{ (Input::old('teamname')) ? 'value="' . e(Input::old('teamname')) . '"' : '' }}/>

        </div>
        @if($errors->has('teamname'))
        <p class='error'>{{ $errors->first('teamname') }}</p>
        @endif

        <input type="submit" value="Create" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>
@stop
