<?php

class FriendlistController extends BaseController {

	public function addFriendList($username){
	        $user = User::where('username', '=', $username);

	        if($user->count()){
	            $user = $user->first();
	        $friend   = Friendlist::create(array(
                'id_adding' => Auth::user()->id,
                'id_friend' => $user->id,
            ));

	            return View::make('user.profile')
	                ->with('user', $user);
	        }

	        return View::make('user.profile')
	            ->with('user', false);
	}
}
