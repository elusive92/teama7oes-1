

@extends('layout.main')


@section('content')
<ol class="breadcrumb">
          <li><a href="{{ URL::route('home')}}">Home</a></li>
          <li><a href="{{ URL::route('userprofile', Auth::user()->username) }}">Profile</a></li>
          <li class="active">Black List</li>
</ol>

  @if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
  @endif


     <div class='form'>
                   {{ Form::open( array('route' => 'postBlacklist')) }}


                    <div class="form-group">
                    <label>Nick:</label> {{Form::text('bannedplayer')}}</div>

                      <input type="submit" value="Add" class="btn btn-default"/>
                    {{Form::close()}}
        	</div>
        	<br><br>


    @if($blacklists ->count())
        <table class=" table table-bordered table-striped">
        <thead>
            <tr>Username</tr>

        </thead>
        <tbody>
        @foreach($blacklists as $blacklist)


                   <tr>
                        <td>{{ e($blacklist->user->username) }} </td>
                    <td>
                        {{Form::open(array(URL::route('delPlayer'), 'method'=>'DELETE'))}}
                        {{Form::hidden('id', $blacklist->id)}}
                        <button type="submit"  class="btn btn-danger btn pull-right">Delete</button>
                        {{Form::close()}}
                    </td>
                   </tr>

        @endforeach

        </tbody>
        </table>



    @endif


@stop