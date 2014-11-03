<?php

class TeamController extends BaseController {



    public function getTeam(){
        return $this -> teamname;
    }

    public function showTeamsearch(){
		return View::make('team.teamsearch');
	}

	public function TeamsearchResult(){
		$validator = Validator::make(
            array(
                'name' => Input::get('name'),
            ),
            array(
                'name'	 	=> 'required',
            )
        );
	if($validator->fails()){
			return Redirect::route('teamsearch')
				->withErrors($validator);
		}else{
			$name = Input::get('name')
			$teamss = team::where('teamname', 'LIKE', '%'.$name.'%')->get();

			var_dump('serach reasult')

			foreach ($teamss as $team) {
				var_dump($teamss->teamname)
				# code...
			}
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
                'id'       => $userid,
                //'idgame'   => $idgame
			));
			
			
			if($team) {
				$teamid = $team->id;
				$teammember = Teammember::create(array(
                    'id'     => $userid,
					'idteam' => $teamid,
					'joindate' => date("Y-m-d H:i:s")
					//'leftdate' => ,
				));
				if($teammember) {
					return Redirect::action('TeamController@teamprofile', array('teamname' => $teamname));
				}
				
			}
			
			
		}
		
	}

    public function teamprofile($teamname){
        $team = Team::where('teamname', '=', $teamname);

        if($team->count()){
            $team = $team->first();


            return View::make('team.teamprofile')
                ->with('team', $team);
        }

        return View::make('team.teamprofile')
            ->with('team', false);
    }

    public function myTeam(){
        if(Auth::check()){
            $teammember = Teammember::where('id', '=', Auth::user()->id)
                ->whereNull('leftdate');
            //->where('idgame', '=', KOEKGEJ);
            if($teammember->count()) {
                $teammember = $teammember->first();
                if ($teammember) {
                    $idteam = $teammember->idteam;
                    $team = Team::where('idteam', '=', $idteam)
                        ->where('status', '=', '0');
                    if($team->count()){
                        $team = $team->first();
                        return View::make('team.myteam')
                            ->with('team', $team);
                    }
                }
            }

        }
        return View::make('team.myteam')
            ->with('team', false);


    }


}