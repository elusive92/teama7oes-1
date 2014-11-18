@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
<script>
$(document).ready(function(){
    $('.passwordbutton').click(function(){
        if($('#left').is(':visible')) {
            $('#left').hide();
        }
        else {
        $('#right').hide();
        $('#left').fadeIn();
        }
    });
});

$(document).ready(function(){
    $('.databutton').click(function() {
        if ($('#right').is(':visible')) {
              $('#right').fadeOut();
            if ($("#right").data('lastClicked') !== this) {
               $('#right').fadeIn();
            }
        } 
        else {
            $('#left').hide();
            $('#right').fadeIn();
        }
        $("#right").data('lastClicked', this);
    });
});
</script>

<ol class="breadcrumb">
          <li><a href="{{ URL::route('home')}}">Home</a></li>
          <li><a href="{{ URL::route('userprofile', Auth::user()->username) }}">Profile</a></li>
          <li class="active">Edit profile</li>
</ol>   

    <a class="editprofile">
        <span class="passwordbutton">        
            <button type="button" class="btn btn-default">
          <span>Change password</span>
        </button>
        </span>
    </a>    

  <div id="profile">
    <div id="left">
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
            <input type="submit" value="Save changed" class="btn btn-default"/>
        {{ Form::token() }}
    </form>   
    </div>
    <p></p>
    <a class="editprofile">
        <span class="databutton">        
            <button type="button" class="btn btn-default">
          <span>Edit profile data</span>
        </button>
        </span>
    </a>

    <div id="right">    
        <form action="{{ URL::route('account-edit-post') }}" files="true" method="post" >  
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
                <label for="photo">photo:</label> <input type="file" accept="image/jpeg" name="photo" class="form-control" id="photo" placeholder="photo"/>
            </div>
            @if($errors->has('photo'))
            <p class='error'>{{ $errors->first('photo') }}</p>
            @endif

            <input type="submit" value="Save changed" class="btn btn-default"/>
        {{ Form::token() }}
    </form>   
    </div>   
  </div>
@stop