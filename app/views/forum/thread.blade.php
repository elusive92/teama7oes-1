@extends('layout.main')

@section('title')
	Forum | {{$thread->tittle}}
@stop

@section('content')
<div class="clearfix">
<ol class="breadcrumb pull-left">
      <li><a href="{{ URL::route('forum-home')}}">Forum</a></li>
      <li><a href="{{ URL::route('forum-category', $thread->category_id) }}">Category</a></li>
      <li class="active">{{$thread->title}}</li>
</ol>
    <a href="{{URL::route('forum-delete-thread', $thread->id)}}" class="btn btn-danger pull-right">Delete</a>
</div>

    <div class="well">
     <h1 class="error-color">{{$thread->title}}</h1>
     <h4 class="error-color">By: {{$author}} on {{$thread->date}}</h4>
     <hr>
     <p class="error-color">{{$thread->body}}</p>
    </div>


@stop