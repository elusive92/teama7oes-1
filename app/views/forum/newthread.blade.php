@extends('layout.main')

@section('title')
	<title>Threats</title>
@stop

@section('content')
@if(Session::has('fail'))
  <p class="alert alert-info">{{ Session::get('fail') }}</p>
  @elseif(Session::has('success'))
  <p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
<h1>New Thread</h1>
<form action ="{{URL::route('forum-store-thread', $id)}}" method="post">
<div class="form-group">
    <label for="title">Title: </label>
    <input type="text" class="form-control" name="title" id="title">
</div>
<div class="form-group">
    <label for="body">Body: </label>
    <textarea class="form-control" name="body" id="body"></textarea>
</div>
{{Form::token()}}

<div class="form-group">
   <input type="submit" value="Save Thread" class="btn btn-primary">
</div>

</form>

@stop