@extends('layout.main')

@section('content')
<div class='form'>
    <form action="{{ URL::route('account-create-post') }}" method="post">
        <div class="form-group">
            <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />

        </div>
        @if($errors->has('email'))
        <p class='error'>{{ $errors->first('email') }}</p>
        @endif
        <div class="form-group">
            <label for="Username">Username:</label> <input type="text" name="username" class="form-control" id="Username" placeholder="Username" {{ (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }}/>

        </div>
        @if($errors->has('username'))
        <p class='error'>{{ $errors->first('username') }}</p>
        @endif
        <div class="form-group">
            <label for="Password">Password:</label> <input type="password" name="password" class="form-control" id="Password" placeholder="Password"/>

        </div>
        @if($errors->has('password'))
        <p class='error'>{{ $errors->first('password') }}</p>
        @endif
        <div class="form-group">
            <label for="Password_">Password again:</label> <input type="password" name="password_" class="form-control" id="Password_" placeholder="Password"/>

        </div>
        @if($errors->has('password_'))
        <p class='error'>{{ $errors->first('password_') }}</p>
        @endif

        <input type="submit" value="Create" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>
@stop
