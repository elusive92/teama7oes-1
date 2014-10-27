@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
  <div id="profile">
    <form action="{{ URL::route('account-edit-post') }}" files="true" method="post" >        
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
        <div class="form-group">
            <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />
        </div>
        @if($errors->has('email'))
        <p class='error'>{{ $errors->first('email') }}</p>
        @endif
        <div class="form-group">
            <label for="From">From:</label> <input type="text" name="from" class="form-control" id="from" placeholder="From"/>
        </div>
        @if($errors->has('from'))
        <p class='error'>{{ $errors->first('from') }}</p>
        @endif
        <div class="form-group">
            <label for="about">About:</label> <input type="text" name="about" class="form-control" id="about" placeholder="About"/>
        </div>
        @if($errors->has('about'))
        <p class='error'>{{ $errors->first('about') }}</p>
        @endif
        <div class="form-group">
            <label for="photo">photo:</label> <input type="file" name="photo" class="form-control" id="photo" placeholder="photo"/>
        </div>
        @if($errors->has('photo'))
        <p class='error'>{{ $errors->first('photo') }}</p>
        @endif

        <input type="submit" value="Save changed" class="btn btn-default"/>
        {{ Form::token() }}
    </form>   
      
  </div>
@stop