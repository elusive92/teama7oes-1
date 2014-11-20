@extends('layout.main')

@section('title')
	Inbox
@stop

@section('content')

@foreach($conversations as $conversation)
    @foreach($conversation->messages as $message)
        {{ e($message->text) }}
    @endforeach
@endforeach

@stop