<?php

class HomeController extends BaseController {

	public function showHome(){

		$news = News::where('draft', '=', 0)
		->orderBy('created_at', 'desc')
		->get();


		
		return View::make('home')->with('news', $news);
	}

	public function showNews($id){
		$news = News::where('id', '=', $id)->firstOrFail();

		return View::make('news.show')->with('news', $news);
	}

	public function addNews(){
		return View::make('news.add');
	}

	public function postNews(){
		
	}

	public function showTeams(){
		return View::make('teams');
	}
///////////////tournament///////////////////////////////////
	public function showTournaments(){
		$game = Game::where('id', '=', Cookie::get('gameid'))->first();	
		$tournaments = DB::table('tournaments')
            ->where('status', '=', '0')
            ->where('game_id', '=', Cookie::get('gameid'))
            ->take(20)
            ->get();
		 return View::make('tournaments')
		 ->with('tournaments', $tournaments)
		 ->with('game', $game);

	}

	public function showSearch(){
		return View::make('search')
            ->with('users', false)
            ->with('teams', false);
	}

	public function showForum(){
		return View::make('forum');
	}

}
