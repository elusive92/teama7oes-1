@extends('layout.main')

@section('title')
	Forum Home
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{URL::route('home')}}">Home</a></li>
      <li class="active">Forum</li>

</ol>
@if(Session::has('fail'))
  <p class="alert alert-info">{{ Session::get('fail') }}</p>
  @elseif(Session::has('success'))
  <p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
@if(Auth::check() && Auth::user()->permissions == 2)
<div>
    <a href="" class="btn btn-default" data-toggle="modal" data-target="#group_form">Add Group</a>
</div>
@endif
<div>
    @foreach($groups as $group)
        <div class="panel panel-primary">
            <div class="panel-heading">
            @if(Auth::check() && Auth::user()->permissions == 2)
            <div class="clearfix">
                <h3 class="panel-title pull-left">{{ $group->title }}</h3>
                <a id="add-category-{{$group->id}}" href="#"  data-toggle="modal" data-target="#category_modal"  class="btn btn-success btn-xs  new_category">New Category</a>
                <a id="{{$group->id}}" href="#"  data-toggle="modal" data-target="#group_delete" class="btn btn-danger btn-xs delete_group">Delete</a>
            </div>
            @else
                <h3 class="panel-title">{{ $group->title }}</h3>
            @endif
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

@if(Auth::check() && Auth::user()->permissions == 2)
<div class="modal fade" id="group_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title error-color">New Group</h4>
            </div>
            <div class="modal-body">
                <form id="target_form" method="post" action="{{URL::route('forum-store-group')}}">
                    <div class="form-group{{($errors->has('group_name')) ? ' has-error': ''}}">
                        <label for="group_name" class="error-color">Group Name</label>
                        <input type="text" id="group_name" name="group_name" class="form-control">
                        @if($errors->has('group_name'))
                            <p class="error-color">{{$errors->first('group_name')}}</p>
                        @endif
                    </div>
                    {{Form::token()}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="form_submit">Save</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title error-color">New Category</h4>
            </div>
            <div class="modal-body">
                <form id="category_form" method="post">
                    <div class="form-group{{($errors->has('category_name')) ? ' has-error': ''}}">
                        <label for="category_name" class="error-color">Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-control">
                        @if($errors->has('group_name'))
                            <p class="error-color">{{$errors->first('category_name')}}</p>
                        @endif
                    </div>
                    {{Form::token()}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="category_submit">Save</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="group_delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title error-color">Delete Group</h4>
            </div>
            <div class="modal-body">
                <h3 class="error-color">Are you sure you want to delete this group?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" type="button" class="btn btn-primary" id="btn_delete_group">Delete</a>
            </div>
        </div>

    </div>
</div>
@endif
<script>
    $(document).ready(function(){
        $("#form_submit").click(function(){
            $("#target_form").submit();
        });

         $("#category_submit").click(function(){
                    $("#category_form").submit();
                });
         $('.new_category').click(function()
         {
            var id = event.target.id;
            var pieces = id.split("-");
            $("#category_form").prop('action','{{ URL::asset('/') }}/forum/category/' + pieces[2] + '/new' );
         });

        $(".delete_group").click(function(event)
        {
            $("#btn_delete_group").prop('href', '{{ URL::asset('/') }}/forum/group/' + event.target.id + '/delete');
        });
    });
</script>
@if(Session::has('modal'))
<script type="text/javascript">
    $("{{ Session::get('modal')}}").modal('show');
</script>
@endif
@if(Session::has('category-modal') && Session::has('group-id'))
<script type="text/javascript">
    $("#category_form").prop('action',"{{ URL::asset('/') }}/forum/category/{{Session::get('group-id')}}/new" );
    $("{{ Session::get('category-modal')}}").modal('show');
</script>
@endif
@stop