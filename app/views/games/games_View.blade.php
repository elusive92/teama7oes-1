@extends('layout.main')


@section('content')
<div class="row">
@if($games->count())
    @foreach($games as $game)
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <a href="">
             <img src="{{URL::to('img/gameslogos/'.$game->logo)}}" class="thumbnail img-responsive">
        </a>
        <p>{{$game->gamename}}</p>
        <br>
    </div>
     @endforeach
     @endif
</div>

@stop