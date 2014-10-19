@extends('layout.main')

@section('content')
<div class='form'>
    <form action="{{ URL::route('account-sign-in-post') }}" method="post">
        <div class="form-group">
            <label for="email">Email: </label><input type="text" name="email" class="form-control" id="email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />

        </div>
        @if($errors->has('email'))
        <p class='error'>{{ $errors->first('email') }}</p>
        @endif
        <div class="form-group">
            <label for="password">Password: </label><input type="password" name="password" class="form-control" id="password" placeholder="Password"/>

        </div>
        @if($errors->has('password'))
        <p class='error'>{{ $errors->first('password') }}</p>
        @endif
        <div class="checkbox">
            <input type="checkbox" name="remember" id="remember" />
            <label for="remember">
                Remember me
            </label>
        </div>


        <input type="submit" value="Sign in" class="btn btn-default"/>
        {{ Form::token() }}
    </form>

    <p><a href="{{ URL::route('account-forgot-password') }}" class="btn btn-default">Forgot my password</a></p>
</div>
@stop
