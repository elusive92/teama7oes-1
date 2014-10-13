<?php

/*Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));*/

Route::get('/', array(
	'as' => 'home', 
	'uses' => 'HomeController@home'
));