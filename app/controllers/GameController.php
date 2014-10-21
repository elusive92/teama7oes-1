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
        $gamename 		= Input::get('gamename');
        $descript 	    = Input::get('description');
        $logo 	        = Input::get('logo');

        $game 	= Games::create(array(
            'gamename' => $gamename,
            'descript' => $descript,
            'logo'  => $logo
        ));
        $game->save();


            if($game){
                return Redirect::route('addGame')
                    ->with('flash_notice', 'Game Added!');
            }


        }
   //}

}