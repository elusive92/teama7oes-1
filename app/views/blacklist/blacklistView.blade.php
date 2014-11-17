

@extends('layout.main')


@section('content')
    <h5>{{Auth::user()-> username}} Black List</h5>

    <div class="alert alert-info info2" style="display: none;">
            <ul></ul>
    </div>
     <div class='form'>
                   {{ Form::open( array('route' => 'postBlacklist', 'class'=>'form-horizontal', 'id' => 'banplayer')) }}


                    <div class="form-group">
                        Nick: {{Form::text('bannedplayer')}}</div>

                      <input type="submit" value="Add" class="btn btn-default"/>
                    {{Form::close()}}
        	</div>


    @if($blacklists ->count())
        <table class=" table table-bordered table-striped">
        <thead>
            <tr>Username</tr>

        </thead>
        <tbody>
        @foreach($blacklists as $blacklist)

                    <?php $us = User::where('id','=',$blacklist->id_B)->firstOrFail();
                         ?>
                   <tr>
                        <td>{{$us -> username}} </td>
                    <td>
                        {{Form::open(array(URL::route('delPlayer')))}}
                        {{Form::hidden('id', $blacklist->id)}}
                        <button type="submit"  class="btn btn-danger">Delete</button>
                        {{Form::close()}}
                    </td>
                   </tr>

        @endforeach

        </tbody>
        </table>



    @endif
<script>
    $(document).ready(function(){
        var info = $('.info2');

        $('#banplayer').submit(function(e){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            e.preventDefault();

            var formData = new FormData();
            formData.append('bannedplayer', $('#bannedplayer').val());


            $.ajax({
                url: '{{ URL::route('postBlacklist') }}',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: {'bannedplayer': formData},
                success: function(data){
                info.hide().find('ul').empty();
                console.log(data);
                if(!data.success){
                    $.each(data.error , function(index, error){
                        info.find('ul').append('<li>'+error+'</li>');
                    });
                    info.slideDown();
                }else{
                    location.href = "{{Route::currentRouteName()}}";
                }

                },
                error: function(){}
            });

        });

    });
</script>

@stop