<?php



Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@showHome'
));

Route::get('/home', array(
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

    Route::get('/account/profile', array(
        'as' => 'account-profile',
        'uses' => 'AccountController@getProfile'
    ));

    Route::get('/account/editprofile', array(
        'as' => 'account-editprofile',
        'uses' => 'AccountController@getEditProfile'
    ));

    Route::post('/account/posteditprofile', array(
            'as' => 'account-edit-post',
            'uses' => 'AccountController@postEdit'
    ));

    Route::get('/team/create', array(
        'as' => 'team-create',
        'uses' => 'TeamController@getCreate'
    ));

    Route::post('/team/create', array(
        'as' => 'team-create-post',
        'uses' => 'TeamController@postCreate'
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
        /*

         Route::post('/account/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => function(){
            $validator = Validator::make(
                array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password')
                ),
                array(
                    'email' => 'required|email',
                    'password' => 'required'
                )
            );
            if($validator->fails()){
               return Response::json([
                    'success'=>false,
                    'error'=>$validator->errors()->toArray()
                ]);
            }
                $remember = (Input::has('remember')) ? true : false;

                $auth = Auth::attempt(array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'active' => 1
                ), $remember);

                if($auth){
                    return Redirect::intended('/');
                }else{
                    return Response::json([
                        'success'=>false,
                        'error'=> array('error' => 'Your account might be still not activated.')
                    ]);

                }
                return Redirect::intended('/');
        }));
        */

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

Route::group(array('prefix' => 'admin','before'=>'adminAuth'), function()
{
    Route::get('/', function()
    {
        return 'huehuehueView::make(powiedzmy głwona admina)';
    });
});

//-------------------------------------------------
//----------------Fromularz gier-----------------
////////////////////////////////////////////////////
Route::get('/addGames', array(
    'as' => 'addGame',
    'uses' => 'GameController@getAddGame'
));

Route::post('/addGames', array(
    'as' => 'postAddGame',
    'uses' => 'GameController@postAddGame'
));
//-------------------------------------------------
//---------------------Testowa Galeryja------------
//-------------------------------------------------
Route::get('/ugallery', array(
    'as' => 'ugallery',
    'uses' => 'GalleryController@getGallery'
));