<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return  Redirect::route('playerblacklist');
    ;
});


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

        $idBannedPlayer = User::where('username', '=', $bannedPlayer)->firstOrFail();
        $id2 = $idBannedPlayer->id;
        $result= Blacklist::where('id_A','=',$id1)
            -> where('id_B', '=', $id2)->get();


        $validator = Validator::make(
            array(
                'id_A' => $id1,
                'id_B' => $id2,
            ),
            array(
                'id_A' => 'required|max:11',
                'id_B' => 'required|max:11',
            )
        );

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }elseif($result->count()) {

                return Redirect::route('playerBlackList');

    }

        else{

            $blist = new Blacklist();
            $blist->id_A = $id1;
            $blist->id_B = $id2;
            $blist->date = date("Y-m-d H:i:s");
            $blist -> save();

            if($blist){
                return Redirect::route('playerBlackList');
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
