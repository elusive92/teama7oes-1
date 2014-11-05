<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return  Redirect::route('blacklist');
});


class BlacklistController extends BaseController {



    public function getBlacklist(){

        return View::make('bltest');
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
        $result= Blacklist::where('idA','=',$player)
            -> where('idB', '=', $id2)->get();


        $validator = Validator::make(
            array(
                'idA' => $player,
                'idB' => $id2,
            ),
            array(
                'idA' => 'required|max:11',
                'idB' => 'required|max:11',
            )
        );

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }elseif($result->count()) {

                return Redirect::route('blacklist');

    }

        else{

            $blist = new Blacklist();
            $blist->idA = $player;
            $blist->idB = $id2;
            $blist->date = date("Y-m-d H:i:s");
            $blist -> save();

            if($blist){
                return Redirect::route('blacklist');
            }
        }

    }

    public function postDestroy(){



        $block = Blacklist::find(Input::get('id'));



         if($block->delete()){
            return  Redirect::route('playerBlackList');
        }





    }
}
