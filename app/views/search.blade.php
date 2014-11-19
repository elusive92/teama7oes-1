@extends('layout.main')

@section('title')
	Search
@stop

@section('content')
<script>
$(document).ready(function(){
    $('.leftbutton').click(function(){
        if($('#left').is(':visible')) {
            $('#left').hide();
        }
        else {
        $('#right').hide();
        $('#left').fadeIn();
        }
    });
});

$(document).ready(function(){
	$('.rightbutton').click(function() {
        if ($('#right').is(':visible')) {
              $('#right').fadeOut();
            if ($("#right").data('lastClicked') !== this) {
               $('#right').fadeIn();
            }
        } 
		else {
			$('#left').hide();
			$('#right').fadeIn();
		}
        $("#right").data('lastClicked', this);
	});
});

</script>

    <a class="myteamedit">
        <span class="leftbutton">        
            <button type="button" class="btn btn-default btn-lg">
          <span><img src="{{ URL::asset('/') }}img/ico/down_arrow.png"/></span> Search user
        </button>
        </span>
    </a>
    <a class="myteam">
        <span class="rightbutton">        
            <button type="button" class="btn btn-default btn-lg">
          <span>Search team <img src="{{ URL::asset('/') }}img/ico/down_arrow.png"/></span>
        </button>
        </span>
    </a>


<br><br><br>
	<div id="left">

      <form class="navbar-form navbar-left" role="search">
        {{Form::open(array('url' =>'search-user'))}}
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        {{Form::close()}}
      </form>

	{{Form::open(array('route' =>'search-user'))}}
		{{Form::text('keyword', null, array('placeholder'=> 'Search User'))}}
		{{Form::submit('Search')}}
	{{Form::close()}}
	</div>	

	<div id="right">
	{{Form::open(array('route' =>'search-team'))}}
		{{Form::text('keyword', null, array('placeholder'=> 'Search Team'))}}
		{{Form::submit('Search')}}
	{{Form::close()}}
	</div>
    @if($users)
        @foreach($users as $user)
            <p>{{ e($user->username) }}</p>
            <p>{{ e($user->created_at) }}</p>

        @endforeach
    @endif



@stop