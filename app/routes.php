<?php



Route::get('/', array(
	'as' => 'home', 
	'uses' => 'HomeController@showHome'
));

Route::get('/teams', array(
	'as' => 'teams', 
	'uses' => 'HomeController@showTeams'
));

Route::get('/tournaments', array(
	'as' => 'tournaments', 
	'uses' => 'HomeController@showTournaments'
));

Route::get('/search', array(
	'as' => 'search', 
	'uses' => 'HomeController@showSearch'
));

Route::get('/forum', array(
	'as' => 'forum', 
	'uses' => 'HomeController@showForum'
));

//nie wiem czemu cos takiego nie dziala:
//Route::get('/', 'HomeController@showHome');
//i wszedzie trzeba robic array.

// Admin======================================
//============================================
//Jak chcecie cos grupowego to napiszcie mi co i jak
// ja glupi wiec bez modelu nic nie napisze:)))

Route::group(array('prefix' => 'admin'), function()
{
    Route::get('/', function()
    {
        return View::make('powiedzmy głwona admina');
    });
});


