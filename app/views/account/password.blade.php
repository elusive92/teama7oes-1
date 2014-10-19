@extends('layout.main')

@section('content')
<div class='form'>
    <form action="{{ URL::route('account-change-password-post') }}" method="post">

        <div class="form-group">
            <label for="old_password">Old Password: </label><input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password"/>
            @if($errors->has('old_password'))
            {{ $errors->first('old_password') }}
            @endif
        </div>
        <div class="form-group">
            <label for="password">New Password: </label><input type="password" name="password" class="form-control" id="password" placeholder="New Password"/>
            @if($errors->has('password'))
            {{ $errors->first('password') }}
            @endif
        </div>
        <div class="form-group">
            <label for="password_again">New Password again: </label><input type="password" name="password_again" class="form-control" id="password_again" placeholder="New Password"/>
            @if($errors->has('password_again'))
            {{ $errors->first('password_again') }}
            @endif
        </div>



        <input type="submit" value="Change password" class="btn btn-default"/>
        {{ Form::token() }}
    </form>
</div>
@stop
