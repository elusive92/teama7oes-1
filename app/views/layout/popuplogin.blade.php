
<div id="toPopup">
    <div class="close"></div>
    <!--<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span> -->
    <div id="popup_content"> <!--your content start-->
    <div class="alert alert-info info" style="display: none;">
        <ul></ul>
    </div>
        <form action="{{ URL::route('account-sign-in-post') }}" method="post" id="loginin">
            <div class="form-group">
                <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />

            </div>

            <div class="form-group">
                <label for="Password">Password: </label><input type="password" name="password" class="form-control" id="password" placeholder="Password" />

            </div>
            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">
                    Remember me
                </label>
            </div>

            <br>
            <input type="submit" value="Sign in" class="btn btn-default" />
            {{ Form::token() }}
        </form>

        <p><a href="{{ URL::route('account-forgot-password') }}" class="btn btn-default">Forgot my password</a></p>

    </div> <!--your content end-->

</div> <!--toPopup end-->

<div class="loader"></div>
<div id="backgroundPopup"></div>

<script>
    $(document).ready(function(){
        var info = $('.info');

        $('#loginin').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());


            $.ajax({
                url: '{{ URL::route('account-sign-in-post') }}',
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
