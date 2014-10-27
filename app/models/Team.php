
<?php

class TeamController extends BaseController {


	public function showTeams(){
        return View::make('teams');
    }

    public function getTeam(){
        return $this -> teamname;
    }
}
