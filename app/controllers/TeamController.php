<?php

class TeamController extends BaseController {



    public function getTeam(){
        return $this -> teamname;
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



}