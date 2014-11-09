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
        <span class="leftbutton">Search User</span>
    </a>
    <a class="myteam">
        <span class="rightbutton">Search Team</span>
    </a>


<br><br>
	<div id="left">
	{{Form::open(array('url' =>'search-user'))}}
		{{Form::text('keyword', null, array('placeholder'=> 'Search User'))}}
		{{Form::submit('Search')}}
	{{Form::close()}}
	</div>	

	<div id="right">
	{{Form::open(array('url' =>'search-team'))}}
		{{Form::text('keyword', null, array('placeholder'=> 'Search Team'))}}
		{{Form::submit('Search')}}
	{{Form::close()}}
	</div>

@stop