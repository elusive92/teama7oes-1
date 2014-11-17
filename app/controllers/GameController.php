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

  /**  public function postAddGame(){
        //$image = Input::file('logo');
        $extension = Input::file('logo')->getClientOriginalExtension();

        if($extension == 'jpg' OR $extension == 'png' OR $extension=='jpeg'){

            $filename = Input::file('logo')->getClientOriginalName();
            $destinationPath = 'img/gameslogos/';




        $validator = Validator::make(
            array(
                'gamename'  => Input::get('gamename'),
                'descript'  =>Input::get('descript')),
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
                    ->with('flash_notice', 'Game Added!');
            }


        }

   }else{
            return Redirect::route('addGame');
        }

}*/
    public function postAddGame()
    {

        $extension = Input::file('logo')->getClientOriginalExtension();

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




    }
}