@extends('layout.main')


@section('content')
<div id="myCarousel" class="carousel slide">



    <ol class="carousel-indicators">
    <?php $i=0 ?>
    <?php $x=0 ?>
    @foreach($photos as $photo)

        @if($i === 0)
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <?php $i++ ?>
          @else
            <li data-target="#myCarousel" data-slide-to=$i></li>
            <?php $i++ ?>
          @endif
     @endforeach
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
       @foreach($photos as $photo)

            @if($x === 0)
                <div class="active item">{{ HTML::image($photo->filename)}}
                <div class="carousel-caption"><p>{{$photo -> title}}</p></div>
                </div>

                <?php $x++ ?>
            @else
                   <div class="item">{{ HTML::image($photo->filename) }}
                   <div class="carousel-caption"><p>{{$photo -> title}}</p></div>
                   </div>

            @endif
       @endforeach
        </div>


 <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>


<script type="text/javascript">
$(document).ready(function(){
     $("#myCarousel").carousel({
     interval : 3000,
              pause: false
     });
});
</script>
@stop