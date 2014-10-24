@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
  <div id="profile">

    <form action="{{ URL::route('account-edit-post') }}" method="post">
        <div class="form-group">
            <label for="Email">Email:</label> <input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} />
        </div>
        @if($errors->has('email'))
        <p class='error'>{{ $errors->first('email') }}</p>
        @endif
        <div class="form-group">
            <label for="Password">Actual Password:</label> <input type="password" name="password" class="form-control" id="Password" placeholder="Password"/>
        </div>
        @if($errors->has('password'))
        <p class='error'>{{ $errors->first('password') }}</p>
        @endif
        <div class="form-group">
            <label for="Password_">New Password:</label> <input type="password" name="password_" class="form-control" id="Password_" placeholder="Password"/>
        </div>
        @if($errors->has('password_'))
        <p class='error'>{{ $errors->first('password_') }}</p>
        @endif
        <div class="form-group">
            <label for="Password_2">Repeat New Password:</label> <input type="password" name="password_2" class="form-control" id="Password_2" placeholder="Password"/>
        </div>
        @if($errors->has('password_2'))
        <p class='error'>{{ $errors->first('password_2') }}</p>
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

        {{-- <input type="submit" value="Edit" class="btn btn-default"/> --}}
        {{ Form::token() }}
    </form>
      
      
    
  </div>
@stop