@extends('layout.main')

@section('title')
	@if($team)
	{{ e($team->teamname) }}
	@else
	404
	@endif
@stop

@section('content')
@if($team->id == Auth::check())
<div class="alert alert-info info2" style="display: none;">
        <ul></ul>
</div>
<div class="myteamedit">
    <div class="teamphoto">
            WYBÓR ZDJĘCIA
            {{ Form::open( array('route' => 'team-edit-post', 'class'=>'form-horizontal', 'files' => true)) }}

            {{Form::file('logo')}}

            {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

            {{ Form::close() }}
        </div>
        <div class="data">
            <h5>Teammembers: </h5>
            {{ Form::open( array('route' => 'team-add-player', 'class'=>'form-horizontal')) }}

            {{Form::text('name',null, array('id' => 'name'))}}

            {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

            {{ Form::close() }}
        </div>
    <div class="sep"></div>
</div>
<div id="teamsView" class="myteam">
    <div class="teamphoto">

        <a href="#"><img src="" width="150" height="150" /></a>
    </div>
    <div class="data">
        <h5>From: </h5>

        @if($teammembers)
            <h5>Teammembers: </h5>
            @foreach($teammembers as $teammember)
                <p>{{ e($teammember->user->username) }}</p>
            @endforeach
        @endif
        @if($teaminvitations)
            <h5>Pending invitations: </h5>
            @foreach($teaminvitations as $teaminvitation)
                <p>{{ e($teaminvitation->user->username) }}</p>
            @endforeach
        @endif
    </div>
    <div class="sep"></div>
</div>
<div style="clear:both"></div>
@endif

<script>
    $(document).ready(function(){
        var info = $('.info2');

        $('#addplayer').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('name', $('#name').val());


            $.ajax({
                url: '{{ URL::route('team-add-player') }}',
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