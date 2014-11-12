

@extends('layout.main')


@section('content')
    <h5>{{Auth::user()-> username}} Friend List</h5>

     <div class='form'>
                   {{Form::open(array(URL::route('postfriendlist')) )}}
                    <div class="form-group">
                        Nick: {{Form::text('friendplyer')}}</div>

                      <input type="submit" value="Add!" class="btn btn-default"/>
                    {{Form::close()}}
        	</div>

    @if($friendlists ->count())
        <table class=" table table-bordered table-striped">
        <thead>
            <tr>Username</tr>
        </thead>
        <tbody>
        @foreach($friendlists as $friendlist)

                    <?php $us = User::where('id','=',$friendlist->id_friend)->firstOrFail();;
                         ?>
                   <tr>
                        <td>{{$us -> username}} </td>
                    <td>
                        {{Form::open(array('url'=>'friendlist/destroy'))}}
                        {{Form::hidden('id', $friendlist->id)}}
                        <button type="submit"  class="btn btn-danger">Delete</button>
                        {{Form::close()}}
                    </td>
                   </tr>
        @endforeach
        </tbody>
        </table>
    @endif


@stop