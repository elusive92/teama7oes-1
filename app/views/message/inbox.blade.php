@extends('layout.main')

@section('title')
	Inbox
@stop

@section('content')
<div class="alert alert-info info2" style="display: none;">
        <ul></ul>
</div>
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
        </ul>
        <ul id="otherl" class="list-group">
        </ul>
      </div>
  </div>
  <div class="col-md-8" style="padding-left: 0px;">
    <ul class="list-group" style="margin-bottom: 0px">
        <li id="chathead" class="list-group-item" style="padding: 2px 2px 0px 15px; height: 40px;">
            <h5 class="pull-left" id="chattitle"><strong>Chat</strong></h5>
            <button type="button" id="newmessage" class="btn btn-default pull-right">New conversation</button>
            <form action="" method="post" id="newconv">
            <input class="form-control pull-left" placeholder="Nickname" style="width: 200px" type="text" id="nick" name="nick">
            <input type="submit" id="addconv" class="btn btn-default pull-right" value="Add">
            </form>

        </li>
        <li id="messages" class="list-group-item" style="overflow: auto; height: 400px">

        </li>
        <li class="list-group-item">
        <form action="{{ URL::route('sendMessage') }}" method="post" id="form_input">
            <input type="hidden" name="cid" id="cid" value="">
            <input type="hidden" name="sender" id="sender" value="{{ e(Auth::user()->id) }}"/>
            <textarea id="message" name="message" cols="25" rows="4" maxlength="600" style="width: 485px; height: 60px; resize: none;"></textarea>
            <input type="submit" name="send" id="send" class="btn btn-default" value="Send Message"/>
        </form>
        </li>
    </ul>
  </div>
</div>
<script>
    $(document).ready(function(){

        $.get('friendConvs', function(data){
                $('#friendl').html(data);
        });
        $.get('otherConvs', function(data){
                $('#otherl').html(data);
        });
        $('#newconv').hide();
        $('#form_input').hide();
        $('#cid').val('');
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
        $('.list-group').on('click', '#newmessage', function(e){
            $('#chattitle').hide();
            $('#newmessage').hide();
            $('#newconv').show();
        });
        //$('.getconv').click(function(e){
        $('.list-group').on('click', '.getconv' ,function(e){
            console.log(e);

            var conversation_id = e.target.value;
            //console.log(conversation_id);
            $('#form_input').show();
            $.get('conversation?conversation_id=' + conversation_id, function(data){
            $('#messages').empty();
            $('#chathead').empty();
            $('#chathead').append('<h5 class="pull-left" id="chattitle"><strong>'+data.username+'</strong></h5><button type="button" id="newmessage" class="btn btn-default pull-right">New conversation</button>' +
             '<form action="" method="post" id="newconv"><input class="form-control pull-left" placeholder="Nickname" style="width: 200px" type="text" id="nick" name="nick"> <input type="submit" id="addconv" class="btn btn-default pull-right" value="Add"> </form>');
            $('#newconv').hide();
            $('#cid').val(conversation_id);
            $.get('messages?conversation_id=' + conversation_id, function(data){
            //console.log(data);
                    $('#messages').html(data);

            });
            });
        });

        var interval = setInterval(function(e) {
            var conversation_id = $('#cid').val();
            if(conversation_id){
                $.get('messages?conversation_id=' + conversation_id, function(data){
                //console.log(data);
                        $('#messages').html(data);

                });
                var elem = document.getElementById('messages');
                elem.scrollTop = elem.scrollHeight;
            }
        	}, 1000);

        var interval2 = setInterval(function(e) {
            if($('#friends').hasClass('active')){
                $.get('friendConvs', function(data){

                        $('#friendl').html(data);

                });
            }
            if($('#other').hasClass('active')){
                $.get('otherConvs', function(data){

                        $('#otherl').html(data);

                });
            }

        }, 5000);
        $('#message').keydown(function(event) {
            if (event.keyCode == 13) {
                var formData = new FormData();
                            formData.append('message', $('#message').val());
                            formData.append('cid', $('#cid').val());
                            formData.append('sender', $('#sender').val());

                            $.ajax({
                                url: '{{ URL::route('sendMessage') }}',
                                method: 'post',
                                processData: false,
                                contentType: false,
                                cache: false,
                                dataType: 'json',
                                data: formData,
                                success: function(data) {
                                console.log(data);
                                if(data.success){
                                    $('#message').val('');
                                    }

                                }
                            });
             }
        });
        $('#form_input').submit(function(e) {

        e.preventDefault();

            var formData = new FormData();
            formData.append('message', $('#message').val());
            formData.append('cid', $('#cid').val());
            formData.append('sender', $('#sender').val());

            $.ajax({
                url: '{{ URL::route('sendMessage') }}',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function(data) {
                console.log(data);
                if(data.success){

                    $('#message').val('');
                    }

                }
            });

        });
        $('#chathead').on('submit', '#newconv', function(e){
        var info = $('.info2');
        //$('#newconv').submit(function(e) {
        e.preventDefault();

            var formData = new FormData();
            formData.append('nick', $('#nick').val());

            $.ajax({
                url: '{{ URL::route('addConvs') }}',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function(data) {
                info.hide().find('ul').empty();
                if(!data.success){
                    $.each(data.error , function(index, error){
                        info.find('ul').append('<li>'+error+'</li>');
                    });
                    info.slideDown();
                }else{
                    var conversation_id = data.id;
                        //console.log(conversation_id);
                        $('#form_input').show();
                        $.get('conversation?conversation_id=' + conversation_id, function(data){
                        $('#messages').empty();
                        $('#chathead').empty();
                        $('#chathead').append('<h5 class="pull-left" id="chattitle"><strong>'+data.username+'</strong></h5><button type="button" id="newmessage" class="btn btn-default pull-right">New conversation</button>' +
                         '<form action="" method="post" id="newconv"><input class="form-control pull-left" placeholder="Nickname" style="width: 200px" type="text" id="nick" name="nick"> <input type="submit" id="addconv" class="btn btn-default pull-right" value="Add"> </form>');
                        $('#newconv').hide();
                        $('#cid').val(conversation_id);
                        $.get('messages?conversation_id=' + conversation_id, function(data){
                        //console.log(data);
                                $('#messages').html(data);

                        });
                        });
                }
                }
            });
        });
    });


</script>
@stop