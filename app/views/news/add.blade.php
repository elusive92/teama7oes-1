@extends('layout.main')

@section('title')
    Manage articles
@stop

@section('content')
<form action="{{ URL::route('news-add-post') }}" method="post" class="basic-grey">
    <h1>Add news
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label for="Title">
        <span>Title :</span>
        <input id="name" type="text" name="name" placeholder="Title of article" />
    </label>
    
    <label for="Descript">
        <span>Description :</span>
        <textarea id="message" name="message" placeholder="Your Message to Us"></textarea>
    </label> 
     <label for="Draft">
        <span>Public status :</span><select name="selection">
        <option value="0">Publish</option>
        <option value="1">Draft</option>
        </select>
    </label>    
    <label>
        <span>Upload photo :</span>
        <input id="photo" type="text" name="photo" placeholder="opisz fotke ktora dodasz xD" />
    </label> 
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Send" />
        {{ Form::token() }} 
    </label>    
</form>
@stop

@stop