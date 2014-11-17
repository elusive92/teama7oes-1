<?php


class BlacklistController extends BaseController {




    public function getPlayerBlackList(){

        $blacklists = Blacklist::where('id_A', '=',Auth::user()->id)->get();
        //return View::make('blacklist.blacklistView', compact($blacklists));



            return View::make('blacklist.blacklistView')->with('blacklists', $blacklists);
        }




    public function postBanPlayer()
    {

        $id1 = Auth::user()->id;
        $bannedPlayer = Input::get('bannedplayer');

        $idBannedPlayer = User::where('username', '=', $bannedPlayer)->first();


       if(!$idBannedPlayer){
            return Redirect::action('BlacklistController@getPlayerBlacklist')
                ->with('message', 'There is no such player.');
        }else{
            $id2 = $idBannedPlayer->id;

            $result= Blacklist::where('id_A','=',$id1)
                -> where('id_B', '=', $id2)->get();
        if($result->count()) {

        return Redirect::action('BlacklistController@getPlayerBlacklist')
            ->with('message', 'Player already added.');

    }
        elseif($id1==$id2){
            return Redirect::action('BlacklistController@getPlayerBlacklist')
                ->with('message', 'Cant add yourself.');

        }

        else{

            $blist = new Blacklist();

            $blist->id_A = $id1;
            $blist->id_B = $id2;
            $blist->date = date("Y-m-d H:i:s");
            $blist -> save();

            if($blist){
                return Redirect::action('BlacklistController@getPlayerBlacklist');
            }
        }

    }}

    public function delPlayerB(){

        $block = Blacklist::find(Input::get('id'));
        $deleted = $block->delete();
        if($deleted){
            return  Redirect::action('BlacklistController@getPlayerBlacklist');
        }





    }
}
