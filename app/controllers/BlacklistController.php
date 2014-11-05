<?php
class BlacklistController extends BaseController {

    public function getBlacklist(){

        return View::make('bltest');
    }

    public function getDBlacklist(){
        return View::make('blacklist.D_black');
    }

    public function getPlayerBlackList(){

        $blacklists = Blacklist::where('idA', '=',Auth::user()->id)->get();
        //return View::make('blacklist.blacklistView', compact($blacklists));



        return View::make('blacklist.blacklistView')->with('blacklists', $blacklists);
    }

    public function postBanPlayer()
    {
        $player = Auth::user()->id;
        $bannedPlayer = Input::get('bannedplayer');

        $idBannedPlayer = User::where('username', '=', $bannedPlayer)->firstOrFail();
        $id2 = $idBannedPlayer->id;


        //if($idBannedPlayer){

            $blist = new Blacklist();
            $blist->idA = $player;
            $blist->idB = $id2;
            $blist->date = date("Y-m-d H:i:s");
            $blist -> save();
       // }

    }

    public function postDestroy(){



        $block = Blacklist::find(Input::get('id'));

        var_dump(Input::get('id'));

         if($block->delete()){
            return 'blocked deleted';
        }




    }
}
