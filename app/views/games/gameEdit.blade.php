@extends('layout.main')


@section('content')
@if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<h5>Games</h5>
@if($games ->count())
    <table class=" table table-bordered table-striped">
            <thead>
                Game Name
            </thead>
            <tbody>
            @foreach($games as $game)
                <tr>
                    <td>{{$game->gamename}}</td>
                    <td><a href="{{ URL::route('edit-game-one',$game->id)}}" class="btn btn-default btn-xs">
                                  <span><img src="{{ URL::asset('/') }}img/ico/pencil.png"/></span> Edit game
                            	</a></td>
                    <td>
                        {{Form::open(array(URL::route('delGame'), 'method'=>'POST'))}}
                        {{Form::hidden('id', $game->id)}}
                        <button type="submit"  class="btn btn-danger">Delete</button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
@endif

@stop