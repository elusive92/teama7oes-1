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

    $keyword = Input::get('keyword');

    $users = User::where('username', 'LIKE', '%'.$keyword.'%')->get();

    //var_dump('search results');
    
//    foreach ($users as $user) {
//        var_dump($user->username);
//
//    }
        return View::make('search')->with('users', $users);
	}

//////////////////////////WYSWIETLANIE PROFILU/////////////////////////////////////////

    public function userprofile($username){
        $user = User::where('username', '=', $username);

        if($user->count()){
            $user = $user->first();

            $friend = Friendlist::where('id_adding', '=', Auth::user()->id)
                    ->where('id_friend', '=', $user->id);

            if($friend->first()){   
                $friend = false;
            } else{
                $friend = true;
            }
            return View::make('user.profile')
                ->with('user', $user)
                ->with('friend', $friend);
        }

        return View::make('user.profile')
            ->with('user', false);
    }
///////////////////////////////////////////////////////////////////////////////////////


}