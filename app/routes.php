<?php

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));
