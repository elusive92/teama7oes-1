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
 * @var chuj nie mam pomyslu jak sciezke ustawić
 ------------------------------------------------------------------------------*/
        $filename = $name = Input::file('logo')->getClientOriginalName();
        $destinationPath = 'media/games/';
        Input::file('logo')->move($destinationPath, $filename);


        $validator = Validator::make(
            array(
                'gamename'  => Input::get('gamename'),
                'descript'  =>Input::get('descript')),


            Games::$rules);

        if($validator->fails()){
            return Redirect::route('addGame')
                ->withErrors($validator)
                ->withInput();

        }else{





        $games = new Games;
        $games->gamename 		= Input::get('gamename');
        $games->descript 	    = Input::get('descript');
        $games->logo 	        = $destinationPath . $filename;


        $games->save();



            if($games){
                return Redirect::route('addGame')
                    ->with('flash_notice', 'Game Added!');
            }


        }
   }

}