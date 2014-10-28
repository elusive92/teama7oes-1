@extends('layout.main')


@section('content')
<ul>
    @foreach($photos as $photo)
        <li>

        {{ HTML::image( 'media/gallery/'   ) }}

        </li>
    @endforeach
</ul>