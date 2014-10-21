<?php

class GameController extends BaseController {

    public function getGame(){
        return View::make('games');
    }

    public function getAddGame(){

        return View::make('gameform');
    }

    public function postAddGame(){

/**
        $validator = Validator::make(Input::all(), Games::$rules);
        if($validator->fails()){
            return Redirect::route('addGame')
                ->withErrors($validator)
                ->withInput()
                ->with('flash_notice', 'Error 717');
        }else{*/

        $games = new Games;
        $games->gamename 		= Input::get('gamename');
        $games->descript 	    = Input::get('description');
        $games->logo 	        = Input::get('logo');

        $games->save();



            if($games){
                return Redirect::route('addGame')
                    ->with('flash_notice', 'Game Added!');
            }


        }
   //}

}