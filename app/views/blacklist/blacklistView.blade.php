

@extends('layout.main')


@section('content')

  @if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
  @endif
    <h5>{{Auth::user()-> username}} Black List</h5>


     <div class='form'>
                   {{ Form::open( array('route' => 'postBlacklist')) }}


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
                        {{Form::open(array(URL::route('delPlayer'), 'method'=>'DELETE'))}}
                        {{Form::hidden('id', $blacklist->id)}}
                        <button type="submit"  class="btn btn-danger">Delete</button>
                        {{Form::close()}}
                    </td>
                   </tr>

        @endforeach

        </tbody>
        </table>



    @endif


@stop