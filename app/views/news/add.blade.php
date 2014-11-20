@extends('layout.main')

@section('title')
    Manage articles
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li><a href="{{ URL::route('home')}}">News</a></li>
      <li class="active"> Add new
      </li>
</ol>
<form action="{{ URL::route('news-add-post') }}" method="post" class="basic-grey">
    <h1>Add news
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label for="Title">
        <span>Title :</span>
        <input id="name" type="text" name="title" placeholder="Title of article" />
    </label>
    
    <label for="Descript">
        <span>Description :</span>
        <textarea id="message" name="descript" placeholder="Full description here"></textarea>
    </label> 
     <label for="Draft">
        <span>Public status :</span>
        <select name="draft">
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
    <label>
        <span>Upload photo :</span>
        <input name="photo" id="uploadFile" placeholder="Choose File" disabled="disabled" />
        <div class="fileUpload btn btn-default btn-sm">
            <span><img src="{{ URL::asset('/') }}img/ico/upload.png"/></span> Upload article photo
            <input id="uploadBtn" type="file" class="upload" />
        </div>
    </label>
    <br><h1></h1>
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Send" />
        {{ Form::token() }} 
    </label>    
</form>

<script>
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
</script>
@stop

@stop