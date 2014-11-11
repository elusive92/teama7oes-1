<?php

class TeamController extends BaseController {



    public function getTeam(){
        return $this -> teamname;
    }

    public function showTeamsearch(){
		return View::make('team.teamsearch');
	}

    public function postSearchResults() {

    $keyword = Input::get('keyword');

    $teams = Team::where('teamname', 'LIKE', '%'.$keyword.'%')->get();

    var_dump('search results');
    
    foreach ($teams as $teams) {
        var_dump($team->teamname);
    }
	}

	public function getCreate() {
		return View::make('team.create');
	}
	
	public function postCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'teamname' 		=> 'required|max:50|min:3|unique:teams'
			)
		);
		
		if($validator->fails()){
			return Redirect::route('team-create')
					->withErrors($validator)
					->withInput();
		}else{
            //$idgame = Input::get('idgame');
            $userid = Auth::user()->id;
			$teamname 	= Input::get('teamname');
			$team 	= Team::create(array(
				'teamname' => $teamname,
                'user_id'       => $userid,
                //'idgame'   => $idgame
			));
			
			
			if($team) {
				$teamid = $team->id;

				$teammember = Teammember::create(array(
                    'user_id'     => $userid,
					'team_id' => $teamid,
					'joindate' => date("Y-m-d H:i:s")
					//'leftdate' => ,
				));
				if($teammember) {
					return Redirect::action('TeamController@myTeam');
				}

				
			}
			
			
		}
		
	}

    public function teamprofile($teamname){
        $team = Team::where('teamname', '=', $teamname);

        if($team->count()){
            $team = $team->first();
            $teammembers = Teammember::where('team_id', '=', $team->id)
                ->whereNull('leftdate')
                ->get();

            return View::make('team.teamprofile')
                ->with('teammembers', $teammembers)
                ->with('team', $team);
        }

        return View::make('team.teamprofile')
            ->with('team', false);
    }

    public function myTeam(){
        $teams = DB::table('teams')
            ->where('status', '=', '0')
            //->where('idgame', '=', 'koekgejuch')
            ->orderBy('ranking', 'desc')
            ->take(100)
            ->get();
        if(Auth::check()){
            $teammember = Teammember::where('user_id', '=', Auth::user()->id)
                ->whereNull('leftdate');
            //->where('idgame', '=', KOEKGEJ);
            //die(var_dump($teammember->first()->idteam));
            if($teammember->count()) {
                $teammember = $teammember->first();
                if ($teammember) {
                    $idteam = $teammember->team_id;
                    $team = Team::where('id', '=', $idteam)
                        ->where('status', '=', '0');
                    if($team->count()){
                        $team = $team->first();
                        $teammembers = Teammember::where('team_id', '=', $idteam)
                            ->whereNull('leftdate')
                            ->get();
                        return View::make('team.myteam')
                            ->with('teammembers', $teammembers)
                            ->with('team', $team)
                            ->with('teams', $teams);

                    }
                }
            }

        }
        return View::make('team.myteam')
            ->with('team', false)
            ->with('teams', $teams);


    }

    public function quitTeam(){
        $teammember = Teammember::where('user_id', '=', Auth::user()->id)
            ->whereNull('leftdate');
            //->where('idgame', '=', KOEKGEJUCH2);
        if($teammember->count()){
            $teammember = $teammember->first();
            $teammember->leftdate = date("Y-m-d H:i:s");
            $teammember->save();
            $count = Teammember::where('team_id', '=', $teammember->id)
                ->whereNull('leftdate')
                ->count();
                //->where('idgame', '=', KOEKGEJUCH3);
            $team = Team::where('id', '=', $teammember->team_id);
            if($team->count()){
                $team = $team->first();
                if(($team->user_id == $teammember->user_id) && ($count > 0)){
                    $teammember = Teammember::where('team_id', '=', $team->id)
                        ->whereNull('leftdate');
                    //->where('idgame', '=', KOEKGEJUCH4);
                    if($teammember->count()) {
                        $teammember = $teammember->first();
                        $team->user_id = $teammember->user_id;
                        $team->save();
                    }
                }else{
                    $team->status = 1;
                    $team->save();
                }
            }

        }

        return Redirect::action('TeamController@myTeam');
    }

    public function getEditTeam(){
        if(Auth::check()){
            $teammember = Teammember::where('user_id', '=', Auth::user()->id)
                ->whereNull('leftdate');
            //->where('idgame', '=', KOEKGEJ);
            //die(var_dump($teammember->first()->idteam));
            if($teammember->count()) {
                $teammember = $teammember->first();
                if ($teammember) {
                    $idteam = $teammember->team_id;
                    $team = Team::where('id', '=', $idteam)
                        ->where('status', '=', '0');
                    if($team->count()){
                        $team = $team->first();
                        if($team->user_id == $teammember->user_id) {
                            $teammembers = Teammember::where('team_id', '=', $idteam)
                                ->whereNull('leftdate')
                                ->get();
                            return View::make('team.teamedit')
                                ->with('teammembers', $teammembers)
                                ->with('team', $team);
                        }

                    }
                }
            }

        }
        return Redirect::action('TeamController@myTeam');

    }

    public function postEditTeam(){
        $teammember = Teammember::where('user_id', '=', Auth::user()->id)
            ->whereNull('leftdate');
        //->where('idgame', '=', KOEKGEJUCH2);
        if($teammember->count()){
            $teammember = $teammember->first();
            $team = Team::where('id', '=', $teammember->team_id);
            if($team->count()){
                $team = $team->first();
                if($team->user_id == $teammember->user_id){

                }
            }
        }
        return Redirect::action('TeamController@myTeam');
    }


}