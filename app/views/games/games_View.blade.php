@extends('layout.main')


@section('content')
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
                <img src="{{URL::to('img/gameslogos/'.$game->logo)}}" class="thumbnail img-responsive">
             @else
                <img src="{{ URL::asset('/') }}img/default1.jpg" class="thumbnail img-responsive">
             @endif
        </a>
        <p>{{$game->gamename}}</p>
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