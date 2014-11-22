<?php

class GameController extends BaseController {

    public function getGameViaAjax(){


    }
    public function postGameId()
    {

        if (Request::ajax()) {
            $gameid = Input::get('gameid');

            $game = Game::where('id', '=', $gameid)->firstOrFail();
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
            Image::make($image->getRealPath())->resize('350', '200')->save($destinationPath.$filename);

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


    public function postEditGame(){
        $image = Input::file('logo');
        $description = Input::get('descript');
        $game = Game::where('id','=',Input::get('id'))->first();
        //$gameid = $game->id;
        $gamelogo = $game->logo;


         if($description and $image){
            $extension = Input::file('logo')->getClientOriginalExtension();
            if ($extension == 'jpg' OR $extension == 'png' OR $extension == 'jpeg') {

                $filename = str_random(10) . '.' . $extension;
                $destinationPath = 'img/gameslogos/';
                if ($gamelogo) {
                    File::delete(public_path() . '/' . $destinationPath . $gamelogo);
                }
                $validator = Validator::make(
                    array(
                        'descript'  =>Input::get('descript')),
                    array(
                        'descript' 		    => 'required|min:1|max:255'
                    ));

                if ($validator->fails()) {
                    return Redirect::route('edit-game-one',$game->id)
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    $game->descript = $description;
                    $game->logo = $filename;
                    $game->save();
                    $uploadSuccess = Image::make($image->getRealPath())->resize('350', '200')->save($destinationPath.$filename);
                    if ($game->save() and $uploadSuccess) {
                        return Redirect::route('edit-game-one',$game->id)->with('message', 'Game has been changed');
                    } else {
                        return Redirect::route('edit-game-one',$game->id)->with('message', 'Something went wrong');
                    }
                }
            }else{
                return Redirect::route('edit-game-one',$game->id)->with('message', 'File is not an image or has wrong extension');
            }}
        elseif($image){
            $extension = Input::file('logo')->getClientOriginalExtension();


            if($extension == 'jpg' OR $extension == 'png' OR $extension=='jpeg'){

                $filename = str_random(10) . '.' . $extension;
                $destinationPath = 'img/gameslogos/';
                if($gamelogo){
                    File::delete(public_path().'/'.$destinationPath.$gamelogo);
                }
                $uploadSuccess = Image::make($image->getRealPath())->resize('200', '200')->save($destinationPath.$filename);

                if($uploadSuccess) {
                    $game->logo = $filename;
                    $game->save();
                    return Redirect::route('edit-game-one',$game->id)->with('message', 'Game Logo has been changed');
            }else{
                return Redirect::route('edit-game-one',$game->id)->with('message', 'Something went wrong');}
            }else{
                return Redirect::route('edit-game-one',$game->id)->with('message', 'File is not an image or has wrong extension');
            }
        }elseif($description){
            $validator = Validator::make(
                array(
                    'descript'  =>Input::get('descript')),
                    array(
                        'descript' 		    => 'required|min:1|max:255'
                ));

            if($validator->fails()){
                return Redirect::route('edit-game-one',$game->id)
                    ->withErrors($validator)
                    ->withInput();
        }else{
                $game->descript = $description;
                $game->save();
                return Redirect::route('edit-game-one',$game->id)->with('message', 'Game Description has been changed');
            }
        }


        else{
            return Redirect::route('edit-game-one',$game->id)->with('message', 'Please change something');
        }
    }

    public function getAllEditGames(){
        $games = Game::all();
        return View::make('games.gameEdit')->with('games', $games);
    }

    public function postDeleteGame(){
        $game = Game::find(Input::get('id'));
        if($game->delete()){
            return Redirect::route('edit-game')->with('message', 'Game deleted');
        }
    }

    public function getEditGame($gameid){
        $game = Game::where('id','=',$gameid)->first();

        return View::make('games.gameEditOne')->with('game',$game);
    }

    public function getAllGamesView(){
        $games = Game::all();
        $cookie = Cookie::forget('gameid');
        return View::make('games.games_View')->with('games', $games);

    }

    public function remCookies(){
        $cookie = Cookie::forget('gameid');
        return Redirect::route('gameView')->withCookie($cookie);
    }
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