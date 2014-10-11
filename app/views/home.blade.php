@extends('layouts.main')

@section('content')
	<form role="form">
		<div class="form-group">
		    <label for="logowanie">Login</label>
		    <input type="text" class="form-control" id="logowanie" placeholder="Login">
		</div>
		<div class="form-group">
		    <label for="haslo">Password</label>
		    <input type="password" class="form-control" id="haslo" placeholder="Password">
		</div>
		</br></br></br>
		<p>
			<button type="button" class="btn btn-primary btn-lg btn-block">Login</button>
			<button type="button" class="btn btn-default btn-lg btn-block">Register</button>
		</p>
	</form>
@stop