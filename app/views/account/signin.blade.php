@extends('layout.main')

@section('content')
<div class="alert alert-info info2" style="display: none;">
    <ul></ul>
</div>
<div class='form'>
    <form action="{{ URL::route('account-sign-in-post2') }}" method="post" id="loginin">
        <div class="form-group">
            <label for="email">Email: </label><input type="text" name="email3" class="form-control" id="email3" placeholder="Enter email" {{ (Input::old('email3')) ? 'value="' . e(Input::old('email3')) . '"' : '' }} />

        </div>

        <div class="form-group">
            <label for="password">Password: </label><input type="password" name="password3" class="form-control" id="password3" placeholder="Password"/>

        </div>

        <div class="checkbox">
            <input type="checkbox" name="remember" id="remember" style="margin-left: 0!important" />
            <label for="remember">
                Remember me
            </label>
        </div>


        <input type="submit" value="Sign in" class="btn btn-default"/>
        {{ Form::token() }}
    </form>

    <p><a href="{{ URL::route('account-forgot-password') }}" class="btn btn-default">Forgot my password</a></p>
</div>
<script>
    $(document).ready(function(){
        var info = $('.info2');

        $('#loginin').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('email3', $('#email3').val());
            formData.append('password3', $('#password3').val());


            $.ajax({
                url: '{{ URL::route('account-sign-in-post2') }}',
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
                    location.href = "{{URL::route('home')}}";
                }

                },
                error: function(){}
            });

        });

    });
</script>
@stop
