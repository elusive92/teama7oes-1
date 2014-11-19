@extends('layout.main')

@section('title')
    Manage articles
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li><a href="{{ URL::route('home')}}">News</a></li>
      <li class="active"> Edit news
      </li>
</ol>
<form action="{{ URL::route('news-add-post') }}" method="post" class="basic-grey">
    <h1>Edit news
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label for="Title">
        <span>Title :</span>
        <input id="name" type="text" name="name" placeholder="Title of article" />
    </label>
    
    <label for="Descript">
        <span>Description :</span>
        <textarea id="message" name="message" placeholder="Full description here"></textarea>
    </label> 
     <label for="Draft">
        <span>Public status :</span><select name="selection">
        <option value="0">Publish</option>
        <option value="1">Draft</option>
        </select>
    </label>    
    <label>
        <span>Upload photo :</span>
        <button type="button" class="btn btn-default btn-sm">
          <span><img src="{{ URL::asset('/') }}img/ico/upload.png"/></span> Upload article photo
        </button>
    </label> 
    <br><h1></h1>
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Save edit" />
        {{ Form::token() }} 
    </label>    
</form>
{{ Form::model($news, array('route' => array('news-update', $news->id)), ['method' => 'put'], ['role' => 'form']) }}
{{ Form::label('title', 'Title') }}
{{ Form::text('title', $news->title) }}
{{ Form::label('descript', 'Descript') }}
{{ Form::text('descript', $news->descript) }}
{{ Form::label('draft', 'Draft') }}
{{ Form::text('draft', $news->draft) }}
{{ Form::button('Save', ['type' => 'submit']) }}
{{ Form::close() }}
<br><br>

@stop

@stop