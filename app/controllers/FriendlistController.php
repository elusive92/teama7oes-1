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
                return Redirect::action('UserController@userprofile', array('username' => $username));
	            //return View::make('user.profile')
	            //    ->with('user', $user);
	        }

	        //return View::make('user.profile')
	        //    ->with('user', false);
	}


	///////////////////wyswietlanie w profilu


	public function getPlayerFriendlist(){

        $friendlists = Friendlist::where('id_adding', '=',Auth::user()->id)->get();

        return View::make('friendlist.friendlistView')->with('friendlists', $friendlists);
    }




    public function postFriendPlayer()
    {


        $id1 = Auth::user()->id;
        $friendplyer = Input::get('friendlist');
if($friendplyer){
        $idfriendplyer = User::where('username', '=', $friendplyer)->firstOrFail();
        $id2 = $idfriendplyer->id;

        $result= Friendlist::where('id_adding','=',$id1)
            -> where('id_friend', '=', $id2)->get();

        $validator = Validator::make(
            array(

                'id_adding' => $id1,
                'id_friend' => $id2,
            ),
            array(
                'id_adding' => 'required|max:11',
                'id_friend' => 'required|max:11',
            )
        );

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }elseif($result->count()) {

                return Redirect::route('friendlistPlayer');
    }

        else{
            $blist = new Friendlist();

            $blist->id_adding = $id1;
            $blist->id_friend = $id2;
            $blist->date = date("Y-m-d H:i:s");
            $blist -> save();

            if($blist){
                return Redirect::route('friendlistPlayer');
            }
        }
    } else return Redirect::route('friendlistPlayer');
    }

    public function postDestroy(){
        $block = Friendlist::find(Input::get('id'));

         if($block->delete()){
            return  Redirect::route('friendlistPlayer');
        }
    }


    public function delFriend(){

        $block = Friendlist::find(Input::get('id'));
        $deleted = $block->delete();
        if($deleted){
            return  Redirect::action('FriendlistController@getPlayerFriendlist');
        }
    }


}
