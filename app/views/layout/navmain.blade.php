<div class="container">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
          <li><a href="{{ URL::route('home')}}">Home</a></li>
          @if(Cookie::get('gameid'))
            <li @if(Request::is('team'))class="active"@endif><a href="{{ URL::route('team')}}">Teams</a></li>
            <li @if(Request::is('tournaments'))class="active"@endif><a href="{{ URL::route('tournaments')}}">Tournaments</a></li>
          @endif
          <li @if(Request::is('search'))class="active"@endif><a href="{{ URL::route('search')}}">Search</a></li>
          <li @if(Request::is('forum'))class="active"@endif><a href="{{ URL::route('forum')}}">Forum</a></li>

          <?php  $games = DB::table('games')->select('id','gamename')->take(7)->get();?>
          <li class="dropdown">
                       <a href ="" class="dropdown-toggle" data-toggle="dropdown">Games <span class="caret"></span></a>
                       <ul id = "games" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuDivider">
                       @foreach($games as $game)
                         <li id={{$game->id}}><a href="">{{$game->gamename}}</a></li>
                        @endforeach
                        <li role="presentation" class="divider" style="opacity: 0.6"></li>
                        <li id = "d"><a href="">Main site</a> </li>
                        <li id = "c"><a href ="">More Games</a></li>

                        @if(Auth::check())
                            @if(Auth::user()->permissions==2)
                                <li role="presentation" class="divider" style="opacity: 0.6"></li>
                                <li id = "b"><a href="">Add Game</a></li>
                                <li id = "a"><a href="">Edit Game</a></li>
                            @endif
                        @endif
                        </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
 <script>
      $(document).ready(function(){
            $('#games li').click( function(e){
           $.ajaxSetup({
                         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                       });
               console.log(e)
               e.preventDefault();

               var gameid = this.id;

               if(gameid == 'a'){
                 $.ajax({

                             		method: "GET",

                             		cache: false,

                             		url: '{{ URL::route('edit-game') }}',

                             		contentType: "text/html",

                             		success: function(){location.href = "{{URL::route('edit-game')}}";}


                             })
               }

               else if(gameid == 'b'){
               $.ajax({

               		method: "GET",

               		cache: false,

               		url: '{{ URL::route('getGame2') }}',

               		contentType: "text/html",

               		success: function(){location.href = "{{URL::route('addGame')}}";}


               })



               }else if(gameid == 'c'){
                               $.ajax({

                               		method: "GET",

                               		cache: false,

                               		url: '{{ URL::route('gameView') }}',

                               		contentType: "text/html",

                               		success: function(){location.href = "{{URL::route('gameView')}}";}


                               });



                               }
               else if(gameid == 'd'){
                        $.ajax({
                            method: "GET",
                            cache: false,
                            url: '{{URL::route('gohome1')}}',
                            contentType: "text/html",
                            success: function(){location.href = "{{URL::route('gohome1')}}";}

                        });
               }
               else{
               $.ajax({
                                    url: '{{ URL::route('postGame') }}',
                                     dataType: 'json',
                                     data: {'gameid': gameid},
                                     method: 'POST',

                                    success:function(responce){console.log(responce)
                                    location.href = "{{URL::route('home')}}";}
                                   });
               }



               });
           });
           </script>