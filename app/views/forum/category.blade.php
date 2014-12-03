@extends('layout.main')

@section('title')
	Category
@stop

@section('content')
@if(Auth::check())
<div>
    <a href="{{URL::route('forum-get-new-thread',$category->id)}}" class="btn btn-default">Add Thread</a>
</div>
@endif
<div>

        <div class="panel panel-primary">
            <div class="panel-heading ">
             @if(Auth::check() && Auth::user()->permissions == 2)
            <div class="clearfix">
                <h3 class="panel-title pull-left">{{ $category->title }}</h3>
                <a id="{{$category->id}}" href="#"  data-toggle="modal" data-target="#category_delete" class="btn btn-danger btn-xs pull-right delete_category">Delete</a>
            </div>
            @else
                <h3 class="panel-title pull-left">{{ $category->title }}</h3>
            @endif
            </div>
            <div class="panel body">
            <div class="list-group panel-list-group">
                @foreach($threads as $thread)
                    <a href="{{URL::route('forum-thread',$thread->id)}}" class="list-group-item">{{$thread->title}}</a>
                @endforeach
            </div>
            </div>
        </div>

</div>

@if(Auth::check() && Auth::user()->permissions == 2)
<div class="modal fade" id="category_delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title error-color">Delete Category</h4>
            </div>
            <div class="modal-body">
                <h3 class="error-color">Are you sure you want to delete this category?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" type="button" class="btn btn-primary" id="btn_delete_category">Delete</a>
            </div>
        </div>

    </div>
</div>
@endif
<script>
    $(document).ready(function(){
        $(".delete_category").click(function(event)
        {
            $("#btn_delete_category").prop('href', '{{ URL::asset('/') }}/forum/category/' + event.target.id + '/delete');
        });
    });
</script>
@stop