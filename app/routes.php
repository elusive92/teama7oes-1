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

Route::group(array('before' => 'auth'), function() {

    Route::group(array('before' => 'csrf'), function(){

        Route::post('/account/change-password', array(
            'as' => 'account-change-password-post',
            'uses' => 'AccountController@postChangePassword'
        ));

    });

    Route::get('/account/change-password', array(
        'as' => 'account-change-password',
        'uses' => 'AccountController@getChangePassword'
    ));

    Route::get('/account/sign-out', array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));

});

Route::group(array('before' => 'guest'), function() {

    Route::get('/account/forgot', array(
        'as' => 'account-forgot-password',
        'uses' => 'AccountController@getForgotPassword'
    ));

    Route::post('/account/forgot', array(
        'as' => 'account-forgot-password-post',
        'uses' => 'AccountController@postForgotPassword'
    ));

    Route::group(array('before' => 'csrf'), function() {

        Route::post('/account/create', array(
            'as' => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));

        Route::post('/account/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));
        //Route::post('submit', function(){
        //    $validator = Validator::make(
        //        array(
        //            'email' => Input::get('email')
        //        ),
        //        array(
        //            'email' => 'required'
        //        )
        //    );
        //    if($validator->fails()){
        //       return Response::json([
        //            'success'=>false,
        //            'error'=>$validator->errors()->toArray()
        //        ]);
        //    }
        //    return Response::json(['success' => true]);
        //});

    });

    Route::get('/account/sign-in', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));

    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));


    Route::get('/account/activate/{code}', array(
        'as' => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));

    Route::get('/account/recover/{code}', array(
        'as' => 'account-recover',
        'uses' => 'AccountController@getRecover'
    ));
});

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


