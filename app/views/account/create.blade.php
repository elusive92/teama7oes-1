 @extends('layout.main')

@section('content')
<div class="alert alert-info info2" style="display: none;">
            <ul></ul>
    </div>
<div class='form'>
    <form action="{{ URL::route('account-create-post2') }}" method="post" id="signup2">
        <div class="form-group">
            <label for="Email">Email:</label> <input type="text" name="email3" class="form-control" id="email3" placeholder="Enter email" {{ (Input::old('email3')) ? 'value="' . e(Input::old('email3')) . '"' : '' }} />

        </div>
        <div class="form-group">
            <label for="Username">Username:</label> <input type="text" name="username3" class="form-control" id="username3" placeholder="Username" {{ (Input::old('username3')) ? 'value="' . e(Input::old('username3')) . '"' : '' }}/>

        </div>
        <div class="form-group">
            <label for="Password">Password:</label> <input type="password" name="password3" class="form-control" id="password3" placeholder="Password"/>

        </div>
        <div class="form-group">
            <label for="Password_">Password again:</label> <input type="password" name="password3_" class="form-control" id="password3_" placeholder="Password"/>

        </div>
        <br>
        <input type="submit" value="Create" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>





<script>
    $(document).ready(function(){
        var info = $('.info2');

        $('#signup2').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('email3', $('#email3').val());
            formData.append('username3', $('#username3').val());
            formData.append('password3', $('#password3').val());
            formData.append('password3_', $('#password3_').val());


            $.ajax({
                url: '{{ URL::route('account-create-post2') }}',
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