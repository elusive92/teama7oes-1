@extends('layout.main')

@section('title')
  Create Team
@stop

@section('content')
<div class="alert alert-info info2" style="display: none;">
        <ul></ul>
</div>
<div class='form'>
    <form action="{{ URL::route('team-create-post') }}" id="createteam" method="post">

        <div class="form-group">
            <label for="Teamname">Team name:</label> <input type="text" name="teamname" class="form-control" id="Teamname" placeholder="Team name" {{ (Input::old('teamname')) ? 'value="' . e(Input::old('teamname')) . '"' : '' }}/>

        </div>

        <input type="submit" value="Create" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>

<script>
    $(document).ready(function(){
        var info = $('.info2');

        $('#createteam').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('teamname', $('#Teamname').val());


            $.ajax({
                url: '{{ URL::route('team-create-post') }}',
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
                    location.href = "{{ URL::route('team') }}";
                }

                },
                error: function(){}
            });

        });

    });
</script>
@stop
