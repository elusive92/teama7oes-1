@extends('layout.main')


@section('content')
<ol class="breadcrumb">
          <li><a href="{{ URL::route('home')}}">Home</a></li>
          <li>Games List</li>
</ol>
@if(Auth::check())
    @if(Auth::user()->permissions==2)
        <a href ="{{URL::route('edit-game')}}" class="btn btn-default">Edit Games</a>
        <br><br>
    @endif
@endif
<div class="row">
@if($games->count())
    @foreach($games as $game)
    <div id = "games" class="col-lg-4 col-sm-6 col-xs-12">
        <a href="" id="{{$game->id}}">
            @if($game->logo)
                <img src="{{URL::to('img/gameslogos/'.$game->logo)}}" class="thumbnail img-responsive" width = "300" height="300">
             @else
                <img src="{{ URL::asset('/') }}img/games/default.png" class="thumbnail img-responsive">
             @endif
             <figcaption><h4 class="imgText">{{$game->gamename}}</h4></figcaption>
        </a>
        <br>
    </div>
     @endforeach
     @endif
</div>
<script>
$(document).ready(function(){
  $('#games a').click( function(e){
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
           });
    console.log(e)
    e.preventDefault();

    var gameid = this.id;

                $.ajax({
                  url: '{{ URL::route('postGame') }}',
                  dataType: 'json',
                  data: {'gameid': gameid},
                  method: 'POST',

                   success:function(responce){console.log(responce)
                   location.href = "{{URL::route('home')}}";}
                    });




               });
           });
</script>

@stop