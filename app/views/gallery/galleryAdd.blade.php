@extends('layout.main')


@section('title')
	Gallery
@stop

@section('content')

        @if(Auth::user())
        <a href ="" id="hideshow" class="btn btn-default">Add photo</a><br><br>
        <div id="photoform">
        {{Form::open(array(URL::route('ugalleryPost'), 'files'=>true, 'id'=>'addphoto' ))}}
            <div class="form-group">
                 <label>Title:</label> {{Form::text('title')}}</div>
            <div class="form-group">
                <label>Photo description:</label><br> {{Form::textarea('descript')}}</div>
            <div class="form-group">
                {{Form::hidden('id', Auth::user()->id)}}
                <label>Image:</label> {{Form::file('image')}}
            </div>
            <input type="submit" value="Create" class="btn btn-default"/>
         {{Form::close()}}
        <br><br></div>
        @endif
        <script>
        $(document).ready(function(){
             var info = $('.info2');
             $('#addphoto').submit(function(e){
             $.ajaxSetup({
                 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
             });
             e.preventDefault();
             var formData = new FormData($(this)[0]);

             $.ajax({
                     url: '{{ URL::route('ugalleryPost') }}',
                     type: 'POST',
                     data: formData,
                     async: false,
                     cache: false,
                     contentType: false,
                     processData: false,

                     success: function(data){
                     info.hide().find('ul').empty();
                     console.log(data);
                     if(!data.success){
                     $.each(data.error , function(index, error){
                     info.find('ul').append('<li>'+error+'</li>');
                      });
                     info.slideDown();
                     }else{
                     location.href = "{{URL::route('ugallery')}}";
                     }
                     },
                     error: function(){}
             });

        });
        });
   </script>
@stop