<?php

class GameController extends BaseController {

    /** public function getGame($gamename){
        //$games = DB::table('games')->select('id', 'gamename')->get();
        $game = Game::where('gamename', '=', $gamename)->firstOrFail();

         if($game) {
             $gameid = $game->id;

             return View::make('tournaments')
                 //->with('games', $games)
                 ->withCookie(Cookie::queue('gameid', $gameid, 60 * 24));
         }else{
             return View::make('tournaments');
         }

    }*/

    public function postGameId(){

        if (Request::ajax()){


            return Response::json(Cookie::queue('gameid',Input::get('gameid'),60*24));
    }
   }


   /** public function getGames(){
        $games = DB::table('games')->select('id', 'gamename')->get();
        //$games = Game::all();
        return View::make('tournaments')
                                ->with('games', $games) ;
    }*/

    public function getAddGame(){

        return View::make('gameform');
    }

    public function postAddGame(){

        //$image = Input::file('logo');

/** -----------------------------------------------------------------------------
 * @var
 ------------------------------------------------------------------------------*/


        $extension = Input::file('logo')->getClientOriginalExtension();

        if($extension == 'jpg' OR $extension == 'png' OR $extension=='jpeg'){

            $filename = Input::file('logo')->getClientOriginalName();
            $destinationPath = 'media/games/';
            Input::file('logo')->move($destinationPath, $filename);



        $validator = Validator::make(
            array(
                'gamename'  => Input::get('gamename'),
                'descript'  =>Input::get('descript')),
               // 'logo'      =>Input::file('logo')->getMimeType()),

            Game::$rules);

        if($validator->fails()){
            return Redirect::route('home')
                ->withErrors($validator)
                ->withInput();

        }else{





        $games = new Game;
        $games->gamename 		= Input::get('gamename');
        $games->descript 	    = Input::get('descript');
        $games->logo 	        = $filename;


        $games->save();



            if($games){
                return Redirect::route('addGame')
                    ->with('flash_notice', 'Game Added!');
            }


        }

   }else{
            return Redirect::route('home');
        }

}

}
