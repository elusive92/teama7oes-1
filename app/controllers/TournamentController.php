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

	public function joinTournament($id){
        $tournament = Tournament::where('id', '=', $id)->firstOrFail();
        $teams = Team::where('user_id','=', Auth::user()->id)
                    ->where('game_id', '=', Cookie::get('gameid'));

        $idTournament=$tournament->id;
        $idteam = $teams->first()->id;

        $joinMember = Tournamentmember::create(array(
                'tournament_id' => $idTournament,
                'team_id' => $idteam
            ));
        if($joinMember){
            return Redirect::route('home');
        }
        
	}


    public function showTournament($id){
        $tournament = Tournament::where('id', '=', $id)->firstOrFail();

        if(Auth::check()){
            $teams = Team::where('user_id','=', Auth::user()->id)
                    ->where('game_id', '=', Cookie::get('gameid'));
            $teamid = $teams->first()->id;
            $torunamentid = $tournament->first()->id;

            $teammembers = Tournamentmember::where('team_id','=',$teamid)
                            ->where('tournament_id','=',$torunamentid);

            if($teams->first()){
                if($teammembers->first()){
                    $addteam= false;
                }else
                $addteam = true;
            } else $addteam = false;
        } else $addteam = false;

        return View::make('tournament.show')->with('tournament', $tournament)
                                            ->with('addteam', $addteam);
    }

	

}