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

          <?php  $games = DB::table('games')->select('gamename')->get();?>

                       <a href ="" class="dropdown-toggle" data-toggle="dropdown">Games <span class="caret"></span></a>
                       <ul id = "games" class="dropdown-menu" role="menu">
                       @foreach($games as $game)
                         <li id={{$game->gamename}}><a href="">{{$game->gamename}}</a></li>
                        @endforeach
                        @if(Auth::check())
                            @if(Auth::user()->permissions==2)
                                <li id = "0"><a href="">Add</a></li>
                            @endif
                        @endif
                   </ul>
                   </ul>
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

               if(gameid != 0){
               $.ajax({
                     url: '{{ URL::route('postGame') }}',
                      dataType: 'json',
                      data: {'gameid': gameid},
                      method: 'POST',



                     success:function(responce){console.log(responce)
                     location.href = "{{URL::route('home')}}";}
                    })
               }else{
               $.ajax(

               		{

               		method: "GET",

               		cache: false,

               		url: '{{ URL::route('getGame2') }}',

               		contentType: "text/html",

               		success: function(){location.href = "{{URL::route('addGame')}}";}


               });



               }



               });
           });
           </script>