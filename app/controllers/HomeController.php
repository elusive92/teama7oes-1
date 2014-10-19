<?php

class HomeController extends BaseController {

	public function showHome(){
		return View::make('home');
	}

	public function showTeams(){
		return View::make('teams');
	}

	public function showTournaments(){
		return View::make('tournaments');
	}

	public function showSearch(){
		return View::make('search');
	}

	public function showForum(){
		return View::make('forum');
	}

}
