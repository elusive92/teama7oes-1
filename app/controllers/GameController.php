<?php

class GameController extends BaseController {

    public function getGame(){
        return View::make('games');
    }

    public function getAddGame(){

        return View::make('gameform');
    }

    public function postAddGame(){

        //$image = Input::file('logo');
/** -----------------------------------------------------------------------------
 * @var
 ------------------------------------------------------------------------------*/


        $extension = Input::file('logo')->getClientOriginalExtension();

        if($extension == 'jpg' OR $extension == 'png'){

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
    public function getGameId($gamename){
        $gameid = Game::where('gamename','=',$gamename)->firstOrFail();
        return View::make('games')->with('gameid',$gameid->id);
    }
}
