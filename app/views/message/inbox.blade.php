@extends('layout.main')

@section('title')
	Inbox
@stop

@section('content')
<div class="row">
  <div class="col-md-4">
  <ul class="list-group" style="margin-bottom: 0px">
    <li class="list-group-item">
        <button type="button" id="friends" class="btn btn-default active" style="width: 49%;">Friends</button>
        <button type="button" id="other" class="btn btn-default" style="width: 49%;">Other</button>
    </li>
  </ul>
      <div style="height: 400px; overflow: auto;">
        <ul id="friendl" class="list-group">
        @foreach($friends as $friend)
            @if($friend->userA->id == Auth::user()->id)
                <li class="list-group-item">
                    @if($friend->userB->photo)
                        <img src="{{ $friend->userB->photo }}" width="30" height="30" />
                    @else
                        <img src="{{ URL::asset('/') }}img/default1.jpg" width="30" height="30" />
                    @endif
                    <button type="button" value="{{ e($friend->id) }}" class="btn btn-link getconv">
                        {{ e($friend->userB->username) }}
                    </button>
                </li>
            @else
                <li class="list-group-item">
                    @if($friend->userA->photo)
                        <img src="{{ $friend->userA->photo }}" width="30" height="30" />
                    @else
                        <img src="{{ URL::asset('/') }}img/default1.jpg" width="30" height="30" />
                    @endif
                    <button type="button" value="{{ e($friend->id) }}" class="btn btn-link getconv">
                        {{ e($friend->userA->username) }}
                    </button>
                </li>
            @endif
        @endforeach
        </ul>
        <ul id="otherl" class="list-group">
        @foreach($others as $other)
            @if($other->userA->id == Auth::user()->id)
                <li class="list-group-item">
                    @if($other->userB->photo)
                        <img src="{{ $other->userB->photo }}" width="30" height="30" />
                    @else
                        <img src="{{ URL::asset('/') }}img/default1.jpg" width="30" height="30" />
                    @endif
                    <button type="button" value="{{ e($other->id) }}" class="btn btn-link getconv">
                        {{ e($other->userB->username) }}
                    </button>
                </li>
            @else
                <li class="list-group-item">
                    @if($other->userA->photo)
                        <img src="{{ $other->userA->photo }}" width="30" height="30" />
                    @else
                        <img src="{{ URL::asset('/') }}img/default1.jpg" width="30" height="30" />
                    @endif
                    <button type="button" value="{{ e($other->id) }}" class="btn btn-link getconv">
                        {{ e($other->userA->username) }}
                    </button>
                </li>
            @endif
        @endforeach
        </ul>
      </div>
  </div>
  <div class="col-md-8" style="padding-left: 0px;">
    <ul class="list-group" style="margin-bottom: 0px">
        <li id="chathead" class="list-group-item" style="padding: 2px 2px 0px 15px; height: 40px;">
            <h5 class="pull-left">Chat</h5>
            <button type="button" id="newmessage" class="btn btn-default pull-right">New message</button>
        </li>
        <li id="messages" class="list-group-item" style="height: 400px">

        </li>
    </ul>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('#otherl').hide();
        $('#other').click(function(){
            $(this).addClass('active');
            $('#friends').removeClass('active');
            $('#friendl').hide();
            $('#otherl').show();
        });
        $('#friends').click(function(){
            $(this).addClass('active');
            $('#other').removeClass('active');
            $('#otherl').hide();
            $('#friendl').show();
        });
        $('.getconv').click(function(e){
            console.log(e);

            var conversation_id = e.target.value;
            //console.log(conversation_id);

            $.get('conversation?conversation_id=' + conversation_id, function(data){
            $('#messages').empty();
            $('#chathead').empty();
            $('#chathead').append('<h5 class="pull-left">'+data.username+'</h5><button type="button" id="newmessage" class="btn btn-default pull-right">New message</button>');
                $.each(data.messages, function(index, messages){
                    $('#messages').append(messages.text);
                });
            });

        });
    });


</script>
@stop