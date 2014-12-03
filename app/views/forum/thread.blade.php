@extends('layout.main')

@section('title')
	Forum | {{$thread->tittle}}
@stop

@section('content')
<div class="clearfix">
<ol class="breadcrumb pull-left">
      <li><a href="{{URL::route('home')}}">Home</a></li>
      <li><a href="{{ URL::route('forum-home')}}">Forum</a></li>
      <li><a href="{{ URL::route('forum-category', $thread->category_id) }}">{{$thread->category->title}}</a></li>
      <li class="active">{{$thread->title}}</li>
</ol>
@if(Session::has('fail'))
  <p class="alert alert-info">{{ Session::get('fail') }}</p>
  @elseif(Session::has('success'))
  <p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
    @if(Auth::check() && Auth::user()->permissions==2)
    <a href="{{URL::route('forum-delete-thread', $thread->id)}}" class="btn btn-default">Delete</a><br><br>
    @endif
</div>

    <div class="well">
     <h1 class="error-color">{{$thread->title}}</h1>
     <h4 class="error-color">By: {{$author}} on {{$thread->date}}</h4>
     <hr>
     <p class="error-color">{{$thread->body}}</p>
    </div>

@foreach($thread->comments()->get() as $comment)
      <div class="well">

         <h4 class="error-color">By: {{$comment->author->username}} on {{$comment->data}}</h4>
         <hr>
         <p class="error-color">{{$comment->body}}</p>
         @if(Auth::check() && Auth::user()->permissions==2)
         <a href="{{URL::route('forum-delete-comment', $comment->id)}}" class="btn btn-default">Delete Comment</a>
         @endif
        </div>
@endforeach

@if(Auth::check())
    <form action ="{{URL::route('forum-store-comment', $thread->id)}}" method="post">
    <div class="form-group">
        <label for="body">Body: </label>
        <textarea class="form-control" name="body" id="body"></textarea>
    </div>
    {{Form::token()}}

    <div class="form-group">
       <input type="submit" value="Save Comment" class="btn btn-primary">
    </div>

    </form>
@endif
@stop