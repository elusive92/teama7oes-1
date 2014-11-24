@extends('layout.main')

@section('title')
	Tournaments
@stop

@section('content')
	tournaments
	{{Cookie::get('gameid')}}
<div class="lista">
<table class="table table-bordered table-striped">
    <thead>
        <!--<h2>Ranking</h2> -->
    </thead>
    <tr>
        <td></td>
        <td>Tournament Name</td>
        <td>Date</td>
    </tr>

    </tr>
</table>
</div>

@if(Auth::check())
    @if(Auth::user()->permissions == 1)
        <div id="brejker">
        <div class="newsbutton">
        <a href="{{ URL::route('tournament-add')}}" class="btn btn-default btn-xs">
          <span><img src="{{ URL::asset('/') }}img/ico/pencil.png"/></span> Add Tournament
        </a>
        <a href="{{ URL::route('manage-tournament')}}" class="btn btn-default btn-xs">
          <span><img src="{{ URL::asset('/') }}img/ico/news.png"/></span> Manage Tournament
        </a>
        </div>
        </div>
    @endif
@endif

@stop