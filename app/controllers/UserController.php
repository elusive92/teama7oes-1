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

    var_dump('search results');
    
    foreach ($users as $user) {
        var_dump($user->username);
    }   
	}

//////////////////////////WYSWIETLANIE PROFILU/////////////////////////////////////////

    public function addFriend($username){
        $user = User::where('username', '=', $username);

        if($user->count()){
            $user = $user->first();

            return View::make('user.profile')
                ->with('user', $user);
        }

        return View::make('user.profile')
            ->with('user', false);
    }
///////////////////////////////////////////////////////////////////////////////////////


}