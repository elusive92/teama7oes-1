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
