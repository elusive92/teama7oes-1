@extends('layout.main')

@section('title')
  Profile
@stop

@section('content')
<div class='form'>
   
    <table>
       <tr>
           <td colspan="2" >Profil</td>
       </tr>
       <tr>
           <td><p><img src="{{ Auth::user()->photo }}"/><p></td>
           <td><p>UserName: {{ Auth::user()->username }}<p>
            <p>About: {{ Auth::user()->about }}<p>
           </td>
       </tr>
       <tr>  
        <td colspan="2" > 
           <input id="Edycja" type="button" value="edytuj" />
           <input id="DodawanieGier" type="button" value="dodaj gre" />
        </td>
       </tr>
   </table>

</div>

@stop