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
{{Form::open(array('url' => '/news-edit/update', 'files' => true, 'class'=>'basic-grey'))}} 
<div class="basic-grey">
  <input name="newsid" type="hidden" value="{{e($news->id)}}">
    <h1>Edit news
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label for="Title">
        <span>Title :</span>
        {{ Form::text('title', $news->title) }}
    </label>
    
    <label for="Descript">
        <span>Description :</span>
        {{ Form::text('descript', $news->descript) }}
    </label> 
     <label for="Draft">
        <span>Public status :</span>
        {{ Form::select('draft', ['publi', 'draft'], 0) }}
<!--         <select name="draft">
        <option value="0">Publish</option>
        <option value="1">Draft</option>
        </select> -->
    </label>    
    <label>
        <span>Upload photo :</span>
        <input name="photo" id="uploadFile" placeholder="Choose File" disabled="disabled" />
        <div class="fileUpload btn btn-default btn-xs">
            <span><img src="{{ URL::asset('/') }}img/ico/upload.png"/></span> Upload article photo
        <!--    <input id="uploadBtn" type="file" class="upload" />-->
            {{Form::file('image', array('class' => 'upload'))}}
        </div>
    </label>
    <br><h1></h1>
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Save edit" />
    </label>    
</div>
{{ Form::close() }}



@stop

@stop