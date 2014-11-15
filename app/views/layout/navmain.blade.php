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
          <li @if(Request::is('team'))class="active"@endif><a href="{{ URL::route('team')}}">Teams</a></li>
          <li @if(Request::is('tournaments'))class="active"@endif><a href="{{ URL::route('tournaments')}}">Tournaments</a></li>
          <li @if(Request::is('search'))class="active"@endif><a href="{{ URL::route('search')}}">Search</a></li>
          <li @if(Request::is('forum'))class="active"@endif><a href="{{ URL::route('forum')}}">Forum</a></li>

<<<<<<< HEAD
          <?php  $games = DB::table('games')->select('gamename')->get();?>

                       <a href ="" class="dropdown-toggle" data-toggle="dropdown">Games <span class="caret"></span></a>
                       <ul id = "games" class="dropdown-menu" role="menu">
                       @foreach($games as $game)
                         <li id={{$game->gamename}}><a href={{URL::to('/games/'.$game->gamename)}}>{{$game->gamename}}</a></li>
                        @endforeach
                   </ul></ul>
=======
           <?php  $games = DB::table('games')->select('id','gamename')->get();?>
                     <li>
                               {{Form::open()}}
                          		<select name="game" id="game">
                          		@foreach($games as $game)
                          		<option value="{{$game->id}}">{{$game->gamename}}</option>
                          		@endforeach
                          		</select>
                          		{{ Form::close()}}
                     </li>
                   </ul>
>>>>>>> parent of 90b3b91... 123
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
              


               $.ajax({
                   url: '{{ URL::route('postGame') }}',
                   dataType: 'json',
                   data: {'gameid': gameid},
                   method: 'POST',



                    success:function(responce){console.log(responce)
                    location.href = "{{URL::route('forum')}}";}
               })

               });
           });
           </script>