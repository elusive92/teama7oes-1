@extends('layout.main')

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li>Forget my password</li>
</ol>
<div class="alert alert-info info2" style="display: none;">
        <ul></ul>
</div>
<div class="alert alert-success info7" role="alert" style="display: none;">
    <ul></ul>
</div>
<div class='form'>
    <form action="{{ URL::route('account-forgot-password-post') }}" id="forgetpassword" method="post">
        <div class="form-group">
            <label for="Email">Email: </label><input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }}/>
        </div>
        <br>
        <input type="submit" value="Recover" class="btn btn-default"/>

    </form>
    {{--@if($errors->has('email'))--}}

    {{--<p class='error'>{{ $errors->first('email') }}</p>--}}
    {{--@endif--}}
</div>

<script>
    $(document).ready(function(){
        var info = $('.info2');
        var success = $('.info7');

        $('#forgetpassword').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('email', $('#Email').val());


            $.ajax({
                url: '{{ URL::route('account-forgot-password-post') }}',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function(data){
                info.hide().find('ul').empty();
                success.hide().find('ul').empty();
                console.log(data);
                if(!data.success){
                    $.each(data.error , function(index, error){
                        info.find('ul').append('<li>'+error+'</li>');
                    });
                    info.slideDown();
                }else{
                    $.each(data.error , function(index, error){
                        success.find('ul').append('<li>'+error+'</li>');
                    });
                    success.slideDown();
                    {{--location.href = "{{ URL::route('home') }}";--}}
                }

                },
                error: function(){}
            });

        });

    });
</script>
@stop
