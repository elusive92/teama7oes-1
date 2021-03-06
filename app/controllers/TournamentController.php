<?php

class TournamentController extends BaseController {


////////post create tournaments//////////////////
	public function createTournament(){
        
        $validator = Validator::make(
            array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ),
            array(
                'email' => 'required|email',
                'password' => 'required'
            )
        );

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
        $teams = Team::where('game_id', '=', Cookie::get('gameid'))
                    ->where('user_id','=', Auth::user()->id);

        $idTournament=$tournament->id;
        $idteam = $teams->first()->id;
        $tournamentPlayer = $tournament->numberofplayers;

        $teamsmembers = Teammember::where('team_id','=',$idteam)->get();

        if(sizeof($teamsmembers)>=$tournamentPlayer) {
            $joinMember = Tournamentmember::create(array(
                    'tournament_id' => $idTournament,
                    'team_id' => $idteam
                ));
            if($joinMember){
                return Redirect::route('tournament-show',$id)->with('message', 'Your team has been saved for the tournament');
            }
        } else return Redirect::route('tournament-show',$id)->with('message', 'Your team did not have enough players');
	}


    public function showTournament($id){
        $tournament = Tournament::where('id', '=', $id)->firstOrFail();

        if(Auth::check()){
            $teams = Team::where('user_id','=', Auth::user()->id)
                    ->where('game_id', '=', Cookie::get('gameid'));

            if($teams->first()){
                $teamid = $teams->first()->id;
                $torunamentid = $tournament->first()->id;

                $teammembers = Tournamentmember::where('team_id','=',$teamid)
                                ->where('tournament_id','=',$torunamentid);

                if($teams->first()){
                    if($teammembers){
                        $addteam= false;
                    }else
                    $addteam = true;
                } else $addteam = false;
            } else $addteam = false;
        } else $addteam = false;
        if($tournament->status == 2){
            $tournamentmembers = Tournamentmember::where('tournament_id', '=', $id)->get();
            $resultTable = array();
            foreach($tournamentmembers as $tournamentmember){
                $wins = 0;
                $winsA = Match::where('tournament_id', '=', $id)
                    ->where('id_teamsA', '=', $tournamentmember->team->id)
                    ->where('result', '=', 1)
                    ->count();
                $winsB = Match::where('tournament_id', '=', $id)
                    ->where('id_teamsB', '=', $tournamentmember->team->id)
                    ->where('result', '=', 2)
                    ->count();
                $wins = $winsA + $winsB;
                $resultTable[] = array('teamname'=>$tournamentmember->team->teamname,
                    'wins'=>$wins);
            }
            function cmp($a, $b)
            {
                return strcmp($b['wins'], $a['wins']);
            }

            usort($resultTable, "cmp");

            return View::make('tournament.show')->with('tournament', $tournament)
                ->with('addteam', $addteam)
                ->with('tournamentmembers', $resultTable);
        }
        return View::make('tournament.show')->with('tournament', $tournament)
                                            ->with('addteam', $addteam)
            ->with('tournamentmembers', false);
    }

	

}