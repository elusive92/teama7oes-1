<?php

class TournamentController extends BaseController {


////////post create tournaments//////////////////
	public function createTournament(){
		
		 	$tournamentname = Input::get('tournamentname');
            $descript = Input::get('descript');
            $numberofteams   =  Input::get('numberofteams');
            $numberofplayers   =  Input::get('numberofplayers');
            $dateStart   = Input::get('dateStart');
            $dateEnd   =  Input::get('dateEnd'); 
            $game_id = Input::get('gameid');

            if($game_id){
                $tournament   = Tournament::create(array(
                    'name' => $tournamentname,
                    'descript' => $descript,
                    'numberofteams' => $numberofteams,
                    'numberofplayers' => $numberofplayers,
                    'startdate' => $dateStart,
                    'regdate' => $dateEnd,   
                    'game_id' => $game_id
                ));
            }
            if($tournament){
			return Redirect::route('tournaments');
		}
	}

///////make view to edit////////////////////////////
	public function addTournament(){
		 return View::make('tournament.create');
	}

////////manadzment tournaments///////////////////////////
	public function manageTournament(){

	}

	public function joinTournament($idtourn){
        $tournament = Tournament::where('id', '=', $id)->firstOrFail();
        $teams = Team::where('user_id','=', Auth::user()->id)
                    ->where('game_id', '=', Cookie::get('gameid'));

        
        
	}


    public function showTournament($id){
        $tournament = Tournament::where('id', '=', $id)->firstOrFail();

        if(Auth::check()){
            $teams = Team::where('user_id','=', Auth::user()->id)
                    ->where('game_id', '=', Cookie::get('gameid'));

            if($teams->first()){
                $addteam = true;
            } else $addteam = false;
        } else $addteam = false;

        return View::make('tournament.show')->with('tournament', $tournament)
                                            ->with('addteam', $addteam);
    }

	

}