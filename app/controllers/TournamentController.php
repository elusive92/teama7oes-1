<?php

class TournamentController extends BaseController {


////////post create tournaments//////////////////
	public function createTournament(){
		
		 	$tournamentname = Input::get('tournamentname');
            $descript = Input::get('descript');
            $numberofteams   =  Input::get('numberofteams');
            $numberofplayers   =  Input::get('numberofplayers');
            $dateStart   =  Input::get('dateStart');
            $dateEnd   =  Input::get('dateEnd'); 
            $game_id = 1;

            $tournament   = Tournament::create(array(
                'name' => $tournamentname,
                'descript' => $descript,
                'numberofteams' => $numberofteams,
                'numberofplayers' => $numberofplayers,
                'startdate' => $dateStart,
                'regdate' => $dateEnd,
                'game_id' => $game_id
            ));
            if($tournament){
			return Redirect::route('home');
		}
	}

///////make view to edit////////////////////////////
	public function addTournament(){
		 return View::make('tournament.create');
	}

////////manadzment tournaments///////////////////////////
	public function manageTournament(){

	}

	public function joinTournament(){

	}

	

}