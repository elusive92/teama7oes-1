<?php

class TeamController extends BaseController {



    public function getTeam(){
        return $this -> teamname;
    }

    public function showTeamsearch(){
		return View::make('team.teamsearch');
	}

    public function postSearchResults() {

    

    $validator = Validator::make(
            array(
                'keyword' => Input::get('keyword'),
            ),
            array(
                'keyword' => 'required|min:3',
            )
        );

        if($validator->fails()){
            return Redirect::route('search')->with('message', 'too short data');
        } 
            else{

            $keyword = Input::get('keyword');

            $teams = Team::where('game_id', '=', Cookie::get('gameid'))
                        ->where('teamname', 'LIKE', '%'.$keyword.'%')->get();
            if($teams->first()){
                return Redirect::route('search')->with('teams', $teams);               
                }  else 
                return Redirect::route('search')->with('message', 'team are looking for does not exist'); 

            }
        }
    

	public function getCreate() {
        if(Cookie::get('gameid')){
            return View::make('team.create');
        }
        return Redirect::action('HomeController@showHome');
	}
	
	public function postCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'teamname' 		=> 'required|max:50|min:3'
			)
		);
		
		if($validator->fails()){
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
                ]);
		}else{

            //$idgame = Input::get('idgame');
            $userid = Auth::user()->id;
			$teamname 	= Input::get('teamname');
            $team = Team::where('teamname', '=', $teamname)
                ->where('game_id', '=', Cookie::get('gameid'));
            if(!$team->count()){
                $game_id = Cookie::get('gameid');
                $team 	= Team::create(array(
                    'teamname' => $teamname,
                    'user_id'       => $userid,
                    'game_id'   => $game_id
                ));


                if($team) {
                    $teamid = $team->id;

                    $teammember = Teammember::create(array(
                        'user_id' => $userid,
                        'team_id' => $teamid,
                        'joindate' => date("Y-m-d H:i:s")
                        //'leftdate' => ,
                    ));
                    if ($teammember) {
                        return Response::json(['success' => true]);
                    }
                }

				
			}else{
                return Response::json([
                    'success' => false,
                    'error' => array('error' => 'Team with this teamname already exists in this game.'),
                    'redirect' => Redirect::intended('/')
                ]);
            }
			
			
		}
		
	}

    public function teamprofile($teamname){
        if(Cookie::get('gameid')) {
            $team = Team::where('teamname', '=', $teamname)
                ->where('game_id', '=', Cookie::get('gameid'));

            if ($team->count()) {
                $team = $team->first();
                $teammembers = Teammember::where('team_id', '=', $team->id)
                    ->whereNull('leftdate')
                    ->get();
                return View::make('team.teamprofile')
                    ->with('teammembers', $teammembers)
                    ->with('team', $team);
            }else{
                return View::make('team.teamprofile')
                    ->with('team', false);
            }
        }
        return View::make('team.teamprofile')
            ->with('team', false);
    }

    public function myTeam(){
        if(Cookie::get('gameid')) {
            $game = Game::where('id', '=', Cookie::get('gameid'))->first();
            $teams = DB::table('teams')
                ->where('status', '=', '0')
                ->where('game_id', '=', Cookie::get('gameid'))
                ->orderBy('ranking', 'desc')
                ->take(100)
                ->get();
            if (Auth::check()) {
                $teammember = Teammember::where('user_id', '=', Auth::user()->id)
                    ->whereNull('leftdate')
                    ->whereExists(function($query){
                        $query->select(DB::raw(1))
                            ->from('teams')
                            ->whereRaw('teams.id = teammembers.team_id')
                            ->whereRaw('teams.game_id = '. Cookie::get('gameid') .'');
                    });
                //die(var_dump($teammember->first()->idteam));
                if ($teammember->count()) {
                    $teammember = $teammember->first();
                    if ($teammember) {
                        $idteam = $teammember->team_id;
                        $team = Team::where('id', '=', $idteam)
                            ->where('status', '=', '0');
                        if ($team->count()) {
                            $team = $team->first();
                            $teammembers = Teammember::where('team_id', '=', $idteam)
                                ->whereNull('leftdate')
                                ->get();

                            return View::make('team.myteam')
                                ->with('teammembers', $teammembers)
                                ->with('team', $team)
                                ->with('teams', $teams)
                                ->with('game', $game);

                        }
                    }
                } else {
                    $teaminvitations = Teaminvitation::where('user_id', '=', Auth::user()->id)
                        ->get();
                    if ($teaminvitations->count()) {
                        return View::make('team.myteam')
                            ->with('team', false)
                            ->with('teams', $teams)
                            ->with('teaminvitations', $teaminvitations)
                            ->with('game', $game);
                    }
                    return View::make('team.myteam')
                        ->with('team', false)
                        ->with('teaminvitations', false)
                        ->with('teams', $teams)
                        ->with('game', $game);
                }

            }
            return View::make('team.myteam')
                ->with('team', false)
                ->with('teaminvitations', false)
                ->with('teams', $teams)
                ->with('game', $game);

        }
        return Redirect::action('HomeController@showHome');
    }

    public function quitTeam(){
        if(Cookie::get('gameid')) {
            $teammember = Teammember::where('user_id', '=', Auth::user()->id)
                ->whereNull('leftdate')
                ->whereExists(function($query){
                    $query->select(DB::raw(1))
                        ->from('teams')
                        ->whereRaw('teams.id = teammembers.team_id')
                        ->whereRaw('teams.game_id = '. Cookie::get('gameid') .'');
                });
            if ($teammember->count()) {
                $teammember = $teammember->first();
                $teammember->leftdate = date("Y-m-d H:i:s");
                $teammember->save();
                $count = Teammember::where('team_id', '=', $teammember->team_id)
                    ->whereNull('leftdate')
                    ->count();
                $team = Team::where('id', '=', $teammember->team_id);
                if ($team->count()) {
                    $team = $team->first();
                    if (($team->user_id == $teammember->user_id) && ($count > 0)) {
                        $teammember = Teammember::where('team_id', '=', $team->id)
                            ->whereNull('leftdate');
                        if ($teammember->count()) {
                            $teammember = $teammember->first();
                            $team->user_id = $teammember->user_id;
                            $team->save();
                        }
                    } elseif ($count == 0) {
                        $teaminvitations = Teaminvitation::where('team_id', '=', $team->id);
                        $teaminvitations->delete();
                        $team->status = 1;
                        $team->save();
                    }
                }

            }
        }
        return Redirect::action('TeamController@myTeam');
    }

    public function getEditTeam(){
        if(Auth::check()){
            if(Cookie::get('gameid')) {
                $teammember = Teammember::where('user_id', '=', Auth::user()->id)
                    ->whereNull('leftdate')
                    ->whereExists(function($query){
                        $query->select(DB::raw(1))
                            ->from('teams')
                            ->whereRaw('teams.id = teammembers.team_id')
                            ->whereRaw('teams.game_id = '. Cookie::get('gameid') .'');
                    });
                //die(var_dump($teammember->first()->idteam));
                if ($teammember->count()) {
                    $teammember = $teammember->first();
                    if ($teammember) {
                        $idteam = $teammember->team_id;
                        $team = Team::where('id', '=', $idteam)
                            ->where('status', '=', '0');
                        if ($team->count()) {
                            $team = $team->first();
                            if ($team->user_id == $teammember->user_id) {
                                $teammembers = Teammember::where('team_id', '=', $idteam)
                                    ->whereNull('leftdate')
                                    ->get();
                                $teaminvitations = Teaminvitation::where('team_id', '=', $idteam)->get();
                                return View::make('team.teamedit')
                                    ->with('teammembers', $teammembers)
                                    ->with('team', $team)
                                    ->with('teaminvitations', $teaminvitations);
                            }

                        }
                    }
                }
            }

        }
        return Redirect::action('TeamController@myTeam');

    }

    public function postEditTeam(){
        if(Cookie::get('gameid')) {
            $teammember = Teammember::where('user_id', '=', Auth::user()->id)
                ->whereNull('leftdate')
                ->whereExists(function($query){
                    $query->select(DB::raw(1))
                        ->from('teams')
                        ->whereRaw('teams.id = teammembers.team_id')
                        ->whereRaw('teams.game_id = '. Cookie::get('gameid') .'');
                });
            if ($teammember->count()) {
                $teammember = $teammember->first();
                $team = Team::where('id', '=', $teammember->team_id);
                if ($team->count()) {
                    $team = $team->first();
                    if ($team->user_id == $teammember->user_id) {
                        $extension = strtolower(Input::file('logo')->getClientOriginalExtension());
                        $filename = $team->id . '.' . $extension;
                        $destinationPath = 'img/teams/logos/';
                        if (($extension == 'jpg') || ($extension == 'jpeg') || ($extension == 'png')) {
                            if ($team->logo) {
                                File::delete(public_path() . '/' . $destinationPath . $team->logo);
                            }
                            $uploadSuccess = Input::file('logo')->move($destinationPath, $filename);
                            if ($uploadSuccess) {
                                $team->logo = $filename;
                                $team->save();
                                return Redirect::action('TeamController@getEditTeam');
                            }
                        }
                    }
                }
            }
        }
        return Redirect::action('TeamController@myTeam');
    }

    public function TeamKickPlayer(){
        if(Cookie::get('gameid')) {
            $teammember = Teammember::find(Input::get('id'))
                ->whereNull('leftdate');
            if ($teammember->count()) {
                $teammember = $teammember->first();
                $teammember->leftdate = date("Y-m-d H:i:s");
                $teammember->save();
                $count = Teammember::where('team_id', '=', $teammember->team_id)
                    ->whereNull('leftdate')
                    ->count();
                $team = Team::where('id', '=', $teammember->team_id);
                if ($team->count()) {
                    $team = $team->first();
                    if (($team->user_id == $teammember->user_id) && ($count > 0)) {
                        $teammember = Teammember::where('team_id', '=', $team->id)
                            ->whereNull('leftdate');
                        if ($teammember->count()) {
                            $teammember = $teammember->first();
                            $team->user_id = $teammember->user_id;
                            $team->save();
                        }
                    } elseif ($count == 0) {
                        $teaminvitations = Teaminvitation::where('team_id', '=', $team->id);
                        $teaminvitations->delete();
                        $team->status = 1;
                        $team->save();
                    }
                }

            }
        }

        return Redirect::action('TeamController@getEditTeam');

    }

}