<?php
//8===========================================D
//zwykle stronki for all
//8===========================================D

<<<<<<< HEAD
/*Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));*/

Route::get('/', array(
	'as' => 'home', 
	'uses' => 'HomeController@home'
));
=======
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

Route::get('tournaments', function()
{
    return 'Tu beda torunamenty';
});

Route::get('teams', function()
{
    return 'Cokolwiek';
});

Route::get('hailmarcin', function()
{
    return ' All hail wybraniec!';
});

//============================================
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

>>>>>>> origin/master
