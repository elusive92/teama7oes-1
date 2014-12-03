<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2014-10-19
 * Time: 08:44
 */
//** User controller */

class UserController extends BaseController {
    

	public function postSearchResults() {

        $validator = Validator::make(
            array(
                'keyword' => Input::get('keyword'),
            ),
            array(
                'keyword' => 'required',
            )
        );

        if($validator->fails()){
            return Redirect::route('search')->with('users', false)
                    ->with('teams', false);
        } 
            else{

            $keyword = Input::get('keyword');

            $user = User::where('username', 'LIKE', '%'.$keyword.'%')->get();

            if($user->first()){
                return View::make('search')
                ->with('users', $user)
                ->with('teams', false);               
                }  else 
                return View::make('search')
                ->with('users', false)
                ->with('teams', false); 

            }

    }

//////////////////////////WYSWIETLANIE PROFILU/////////////////////////////////////////

    public function userprofile($username){
        $user = User::where('username', '=', $username);

        if($user->count()){
            $user = $user->first();
            if(Auth::check()){   ///////////////////////////////////////////////////////////////TYLKO DLA ZALOGOWANYCH NOW IDEA JAK SPRAWDZIC
                $friend = Friendlist::where('id_adding', '=', Auth::user()->id)
                        ->where('id_friend', '=', $user->id);

                if($friend->first()){   
                    $friend = false;
                } else{
                    $friend = true;
                }
            } else $friend = false;


            //$teams = DB::select('select * from teams where id=(
            //    select team_id from teammembers where user_id=$user->id)', array());
            $teammembers = Teammember::where('user_id', '=', $user->id); 

            return View::make('user.profile')
                ->with('user', $user)
                ->with('friend', $friend)
                ->with('teammembers', $teammembers);
        }

        return View::make('user.profile')
            ->with('user', false);
    }
///////////////////////////////////////////////////////////////////////////////////////


}