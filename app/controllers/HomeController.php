<?php

class HomeController extends BaseController {

	public function home(){
		return View::make('home');
	}

	/*
	public function getIndex()
	{
		return View::make('home');
	}
	*/

}
