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
		$tournaments = DB::table('tournaments')
            ->where('status', '=', '0')
            //->where('idgame', '=', 'koekgejuch')
            ->take(20)
            ->get();
		 return View::make('tournaments')
		 ->with('tournaments', $tournaments);
	}

	public function showSearch(){
		return View::make('search')
            ->with('users', false);
	}

	public function showForum(){
		return View::make('forum');
	}

}
