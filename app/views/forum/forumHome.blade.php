@extends('layout.mainbezfootera')

@section('title')
	Forum Home
@stop

@section('content')
<div>
    @foreach($groups as $group)
        <div class="panel panel-primary">
            <div class="panel-heading ">
                <h3 class="panel-title">{{ $group->title }}</h3>
            </div>
            <div class="panel body">
            <div class="list-group panel-list-group">
                @foreach($categories as $category)
                @if($category->group_id == $group->id)
                    <a href="{{URL::route('forum-category',$category->id)}}" class="list-group-item">{{$category->title}}</a>
                @endif
                @endforeach
            </div>
            </div>
        </div>
    @endforeach
</div>
@stop