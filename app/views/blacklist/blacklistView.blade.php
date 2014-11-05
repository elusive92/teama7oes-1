

@extends('layout.main')


@section('content')
    <h5>{{Auth::user()-> username}} Black List</h5>

    @if($blacklists ->count())
        <table class=" table table-bordered table-striped">
        <thead>
            <tr>Username</tr>

        </thead>
        <tbody>
        @foreach($blacklists as $blacklist)

                    <?php $us = User::where('id','=',$blacklist->idB)->firstOrFail();;
                         ?>
                   <tr>
                        <td>{{$us -> username}} </td>
                    <td>
                        {{Form::open(array('url'=>'blacklist/destroy'))}}
                        {{Form::hidden('id', $blacklist->idblock)}}
                        <button type="submit"  class="btn btn-danger">Delete</button>
                        {{Form::close()}}
                    </td>
                   </tr>

        @endforeach

        </tbody>
        </table>



    @endif

@stop