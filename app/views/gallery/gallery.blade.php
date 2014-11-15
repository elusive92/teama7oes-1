@extends('layout.main')


@section('title')
	Gallery
@stop

@section('content')
    <div id="links">
        @foreach($photos as $photo)
        <a href={{URL::to('media/gallery/'.Auth::user()->id.'/'.$photo->filename)}} tittle={{$photo->tittle}}>
           {{ HTML::image('media/gallery/'.Auth::user()->id.'/thumbnails/'.$photo->filename), $photo->tittle }}
        </a>
        @endforeach
        <a href={{URL::to('media/gallery/2/fire.jpg')}}>
                   {{ HTML::image('media/gallery/2/thumbnails/e1.jpg')}}
                </a>
    </div>
     <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
         <div class="slides"></div>
         <h3 class="title"></h3>
         <a class="prev">‹</a>
         <a class="next">›</a>
         <a class="close">×</a>
         <a class="play-pause"></a>
         <ol class="indicator"></ol>
     </div>

   <script src="js/blueimp-gallery.min.js"></script>
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
@stop