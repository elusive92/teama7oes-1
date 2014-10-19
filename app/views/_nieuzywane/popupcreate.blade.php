<div id="toPopup2">
    <div class="close"></div>
    <!-- <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span> -->
    <div id="popup_content"> <!--your content start-->
        <form action="{{ URL::route('account-create-post') }}" method="post">
            <div class="form-group">
                <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />

            </div>
            <div class="form-group">
                <label for="Username">Username:</label> <input type="text" name="username" class="form-control" id="Username" placeholder="Username" {{ (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }}/>

            </div>
            <div class="form-group">
                <label for="Password">Password:</label> <input type="password" name="password" class="form-control" id="Password" placeholder="Password"/>

            </div>
            <div class="form-group">
                <label for="Password_">Password again:</label> <input type="password" name="password_" class="form-control" id="Password_" placeholder="Password"/>

            </div>
            <br>
            <input type="submit" value="Create" class="btn btn-default"/>
            {{ Form::token() }}
        </form>
    </div> <!--your content end-->

</div> <!--toPopup end-->

<div class="loader"></div>
<div id="backgroundPopup"></div>
