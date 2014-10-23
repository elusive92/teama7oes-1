<div id="toPopup2">
    <div class="close"></div>
    <!-- <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span> -->
    <div id="popup_content"> <!--your content start-->
    <div class="alert alert-info info" style="display: none;">
            <ul></ul>
    </div>
        <form action="{{ URL::route('account-create-post') }}" method="post" id="signup">
            <div class="form-group">
                <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="email2" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />

            </div>
            <div class="form-group">
                <label for="Username">Username:</label> <input type="text" name="username" class="form-control" id="username" placeholder="Username" {{ (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }}/>

            </div>
            <div class="form-group">
                <label for="Password">Password:</label> <input type="password" name="password" class="form-control" id="password2" placeholder="Password"/>

            </div>
            <div class="form-group">
                <label for="Password_">Password again:</label> <input type="password" name="password_" class="form-control" id="password2_" placeholder="Password"/>

            </div>
            <br>
            <input type="submit" value="Create" class="btn btn-default"/>
            {{ Form::token() }}
        </form>
    </div> <!--your content end-->

</div> <!--toPopup end-->

<div class="loader"></div>
<div id="backgroundPopup"></div>

<script>
    $(document).ready(function(){
        var info = $('.info');

        $('#signup').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('email2', $('#email2').val());
            formData.append('username', $('#username').val());
            formData.append('password2', $('#password2').val());
            formData.append('password2_', $('#password2_').val());


            $.ajax({
                url: '{{ URL::route('account-create-post') }}',
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