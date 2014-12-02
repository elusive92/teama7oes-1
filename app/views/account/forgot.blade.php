@extends('layout.main')

@section('content')
<div class='form'>
    <form action="{{ URL::route('account-forgot-password-post') }}" method="post">
        <div class="form-group">
            <label for="Email">Email: </label><input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }}/>
        </div>
        <br>
        <input type="submit" value="Recover" class="btn btn-default"/>

    </form>
    @if($errors->has('email'))

    <p class='error'>{{ $errors->first('email') }}</p>
    @endif
</div>

@stop
