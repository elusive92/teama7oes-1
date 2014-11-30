@extends('layout.mainbezfootera')

@section('title')
	Team Gallery
@stop

@section('content')
@if(Auth::check())
@if(e(Auth::user()->id)==e($user->id))
<div class="alert alert-info info2" style="display: none;">
    <ul></ul>
</div>
<a href ="" id="hideshow" class="btn btn-default">Add photo</a><br><br>
<div id="photoform">
{{Form::open(array(URL::route('ugalleryPost'), 'files'=>true, 'id'=>'addphoto'))}}
    <div class="form-group">
         <label>Title:</label> {{Form::text('title',null,array('class'=>'form-control'))}}</div>
    <div class="form-group">
        <label>Photo description:</label><br> {{Form::textarea('descript',null,array('class'=>'form-control'))}}</div>
    <div class="form-group">
        {{Form::hidden('id', Auth::user()->id)}}
        <label>Image:</label> {{Form::file('image')}}
    </div>
    <input type="submit" value="Add" class="btn btn-default"/>
 {{Form::close()}}
<br><br></div>
@endif
@endif
@if($photos)
 <div class="row">

    <div id="links" class="links">
        @foreach($photos as $photo)
        <div class="col-lg-4 col-sm-6 col-xs-12">
        <a href={{URL::to('img/gallery/'.$tgallery->team_id.'/'.$photo->filename)}} title="{{$photo->title}}">
           {{ HTML::image('img/gallery/'.$tgallery->team_id.'/mini'.$photo->filename) }}
        </a><br><br></div>
        @endforeach
</div></div>
{{$photos->links()}}
@endif


     <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
         <div class="slides"></div>
         <h3 class="title"></h3>
         <a class="prev">‹</a>
         <a class="next">›</a>
         <a class="close">×</a>
         <a class="play-pause"></a>
         <ol class="indicator"></ol>
     </div>

   <script src="{{ URL::asset('/') }}js/blueimp-gallery.min.js"></script>
        <script>
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
   </script>
   <script type="text/javascript">
             $(document).ready(function(){
                 $('#photoform').hide();
                 $('#hideshow').click(function(){
                     $('#photoform').slideToggle('fast');
                     return false;
                 });
             });
   </script>
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
                     dataType: 'json',

                     success: function(data){
                     info.hide().find('ul').empty();
                     console.log(data);
                     if(!data.success){
                        $.each(data.error , function(index, error){
                            info.find('ul').append('<li>'+error+'</li>');
                        });
                        info.slideDown();
                     }else{
                     location.href = "{{URL::route('ugallery',$user->username)}}";
                     }
                     },
                     error: function(){}
             });

        });
        });
   </script>
@stop