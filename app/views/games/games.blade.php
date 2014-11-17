@extends('layout.main')

@section('title')

@stop

@section('content')
<head>
	<title>Kołek czasem cos robi</title>

	<!-- load bootstrap -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<style>
		body 	{ padding-bottom:40px; padding-top:40px; }
	</style>
</head>
<div class="alert alert-info info2" style="display: none;">
        <ul></ul>
</div>
<body class="container">

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">

		<div class="page-header">
			<h1><span></span>Add Game</h1>
		</div>

		<!-- FORM STARTS HERE -->
		<div class='form'>
            {{ Form::open( array('route' => 'postAddGame1', 'id' => 'addgame')) }}
             <div class="form-group">
            Game Name: {{Form::text('gamename', null, array('id' => 'gamename'))}}</div>
             <div class="form-group">
            Descript: {{Form::text('descript', null, array('id' => 'descript'))}}</div>

            <div class="form-group">
             Logo: {{Form::file('logo')}}
              </div>

            {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

            {{ Form::close() }}
        </div>


    <div class="sep"></div>
</div>
</div>



<script>
    $(document).ready(function(){
        var info = $('.info2');

        $('#addgame').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('gamename', $('#gamename').val());
            formData.append('descript', $('#descript').val());


            $.ajax({
                url: '{{ URL::route('postAddGame1') }}',
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