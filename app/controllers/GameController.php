<?php

class GameController extends BaseController {
    public function postGameId()
    {

        if (Request::ajax()) {
            $gamename = Input::get('gameid');

            $game = Game::where('gamename', '=', $gamename)->firstOrFail();
            $gameid = $game->id;


            return Response::json(Cookie::queue('gameid', $gameid, 60 * 24));

        }
    }

    public function getAddGame(){

            return View::make('games.games');

    }
    public function getDaGame(){
        if(Request::ajax()){
            return Response::json();
        }
    }

    public function postAddGame(){
        $image = Input::file('logo');
        if($image){
        $extension = Input::file('logo')->getClientOriginalExtension();


        if($extension == 'jpg' OR $extension == 'png' OR $extension=='jpeg'){

            $filename = str_random(10) . '.' . $extension;
            $destinationPath = 'img/gameslogos/';




        $validator = Validator::make(
            array(
                'Game name'  => Input::get('gamename'),
                'Descript'  =>Input::get('descript')),
               // 'logo'      =>Input::file('logo')->getMimeType()),

            Game::$rules);

        if($validator->fails()){
            return Redirect::route('addGame')
                ->withErrors($validator)
                ->withInput();

        }else{

        $games = new Game;
        $games->gamename 		= Input::get('gamename');
        $games->descript 	    = Input::get('descript');
        $games->logo 	        = $filename;


        $games->save();
            Input::file('logo')->move($destinationPath, $filename);


            if($games){
                return Redirect::route('addGame')
                    ->with('message', 'Game added.');
            }


        }

   }else{
            return Redirect::route('addGame')
                ->with('message', 'File is not an image or has wrong extension.');
        }

    }else{
            return Redirect::route('addGame')
                ->with('message', 'Pleas choose an image.');
            }}
/**    public function postAddGame()
    {



        $validator = Validator::make(
            array(
                'gamename' => Input::get('gamename'),
                'descript' => Input::get('descript')),
            // 'logo'      =>Input::file('logo')->getMimeType()),

            Game::$rules);

        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }
            $games = new Game;
            $games->gamename 		= Input::get('gamename');
            $games->descript 	    = Input::get('descript');



            $games->save();




    }*/

}