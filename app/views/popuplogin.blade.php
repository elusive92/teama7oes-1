<div id="toPopup">
    <div class="close"></div>
    <!--<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span> -->
    <div id="popup_content"> <!--your content start-->
        <form action="#" method="post">
            <div class="form-group">
                <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />

            </div>

            <div class="form-group">
                <label for="Password">Password: </label><input type="password" name="password" class="form-control" id="Password" placeholder="Password" />

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

        <p><a href="#" class="btn btn-default">Forgot my password</a></p>
        

    </div> <!--your content end-->

</div> <!--toPopup end-->

<div class="loader"></div>
<div id="backgroundPopup"></div>