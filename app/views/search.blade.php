@extends('layout.main')

@section('title')
	Search
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li>Search</li>
</ol>
<div class="alert alert-info info3" style="display: none;">
        <ul></ul>
</div>
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
       
        <div id="searchbtn">
    	{{Form::open(array('route' =>'search-user'))}}
    		{{Form::text('keyword', null, array('placeholder'=> 'Search User', 'id' =>'keyword', 'style'=>'color:black'))}}    
    		{{Form::submit('Search', array('class' => 'btn btn-default'))}}
    	{{Form::close()}}
        </div>

    </div>

	<div id="right">
        <div id="searchbtn">
        	{{Form::open(array('route' =>'search-team'))}}
        		{{Form::text('keyword', null, array('placeholder'=> 'Search Team', 'style'=>'color:black'))}}
        		{{Form::submit('Search', array('class' => 'btn btn-default'))}}
        	{{Form::close()}}
        </div>
	</div>


@if($users)
<div class="panel panel-default">
<div class="panel-heading">Users search results</div>
<table class="table">
    <?php $i = 1; ?>
    <thead></thead>
    <tr>
        <td>#</td>
        <td></td>
        <td>Username</td>
        <td>Joined</td>
    </tr>

    @foreach($users as $user)
    <tr>
        <td><?php echo $i; ?>.</td>
        <td>@if($user->photo)
                {{ HTML::image('img/users/profile/'.$user->photo, '', ['width' => '20', 'height' => '20']) }}
            @else
                <a href="{{ URL::route('userprofile', $user->username) }}"><img src="{{ URL::asset('/') }}img/default1.jpg" width="20" height="20" /></a>
            @endif
        </td>
        <td><a href="{{ URL::route('userprofile', $user->username) }}">{{ e($user->username) }}</a></td>
        <td style="text-align:left">{{ e($user->created_at) }}</td>
        <?php $i++; ?>
    </tr>


    @endforeach
</table>
</div>

@endif


@if($teams)
<div class="panel panel-default">
<div class="panel-heading">teams search results</div>
<table class="table">
    <?php $i = 1; ?>
    <thead></thead>
    <tr>
        <td>#</td>
        <td></td>
        <td>Username</td>
        <td>Joined</td>
    </tr>

    @foreach($teams as $team)
    <tr>
        <td><?php echo $i; ?>.</td>
        <td>@if($team->logo)  img\teams\logos
                {{ HTML::image('img/teams/logos/'.$team->logo, '', ['width' => '20', 'height' => '20']) }}
            @else
                <a href="{{ URL::route('userprofile', $team->username) }}"><img src="{{ URL::asset('/') }}img/default1.jpg" width="20" height="20" /></a>
            @endif
        </td>
        <td><a href="{{ URL::route('teamprofile', $team->teamname) }}">{{ e($team->teamname) }}</a></td>
        <td style="text-align:left">{{ e($team->created_at) }}</td>
        <?php $i++; ?>
    </tr>


    @endforeach
</table>
</div>

@endif






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


    $(document).ready(function(){
        var info = $('.info3');

        $('#searchuser').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('keyword', $('#keyword').val());


            $.ajax({
                url: '{{ URL::route('search-user') }}',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function(data){
                info.hide().find('ul').empty();
                console.log(data);
                if(!data.success){
                    $.each(data.error , function(index, error){
                        info.find('ul').append('<li>'+error+'</li>');
                    });
                    info.slideDown();
                }else{
                    location.href = "{{Route::currentRouteName()}}";
                }

                },
                error: function(){}
            });

        });

        $('#searchteam').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('keyword', $('#keyword').val());


            $.ajax({
                url: '{{ URL::route('search-user') }}',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function(data){
                info.hide().find('ul').empty();
                console.log(data);
                if(!data.success){
                    $.each(data.error , function(index, error){
                        info.find('ul').append('<li>'+error+'</li>');
                    });
                    info.slideDown();
                }else{
                    location.href = "{{Route::currentRouteName()}}";
                }

                },
                error: function(){}
            });

        });

    });
</script>

@stop