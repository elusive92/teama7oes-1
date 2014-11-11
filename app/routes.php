<?php



Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@showHome'
));

Route::get('/news/{id}', array(
    'as' => 'news-show',
    'uses' => 'HomeController@showNews'
));

Route::get('/news-add', array(
    'as' => 'news-add',
    'uses' => 'HomeController@addNews'
));

 Route::post('/news-add', array(
    'as' => 'news-add-post',
    'uses' => 'NewsController@postNews'
));

Route::get('/home', array(
    'as' => 'home',
    'uses' => 'HomeController@showHome'
));

Route::get('/tournaments', array(
	'as' => 'tournaments', 
	'uses' => 'HomeController@showTournaments'
));

Route::get('/search', array(
	'as' => 'search', 
	'uses' => 'HomeController@showSearch'
));



Route::get('/team/{teamname}', array(
    'as' => 'teamprofile',
    'uses' => 'TeamController@teamprofile',
));

Route::post('/search-team', array(
        'as' => 'search-team',
        'uses' => 'TeamController@postSearchResults'
));

///search/team, search/team/results bylo zle chyba
Route::get('/search/team', array(
    'as' => 'teamsearch',
    'uses' => 'TeamController@showTeamsearch',
));

Route::get('/search/team/result', array(
    'as' => 'team-searchTeam',
    'uses' => 'TeamController@showTeamsearchResult',
));


Route::get('/forum', array(
	'as' => 'forum', 
	'uses' => 'HomeController@showForum'
));

Route::get('/team', array(
    'as' => 'team',
    'uses' => 'TeamController@myTeam'
));
///////////////////////////////USER CONTROLER//////////////////////////////////////////

Route::get('/user/{username}', array(
    'as' => 'userprofile',
    'uses' => 'UserController@userprofile',
));

Route::post('/search-user', array(
        'as' => 'search-user',
        'uses' => 'UserController@postSearchResults'
));

/////////////////////////////////// FIREND LIST CONTROLER////////////////////////

Route::get('/user/add/{username}', array(
    'as' => 'addFriendList',
    'uses' => 'FriendlistController@addFriendList', /////dalem tylko zeby bledu nie
));

/////////////////////////////////////////////////////////////////////////////////
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

    Route::get('/account/editprofile', array(
        'as' => 'account-editprofile',
        'uses' => 'AccountController@getEditProfile'
    ));

    Route::post('/account/posteditprofile', array(
            'as' => 'account-edit-post',
            'uses' => 'AccountController@postEdit'
    ));

    Route::get('/team-create', array(
        'as' => 'team-create',
        'uses' => 'TeamController@getCreate'
    ));

    Route::post('/team-create', array(
        'as' => 'team-create-post',
        'uses' => 'TeamController@postCreate'
    ));

    Route::get('/team-quit', array(
        'as' => 'team-quit',
        'uses' => 'TeamController@quitTeam'
    ));

    Route::get('/team-edit', array(
        'as' => 'team-edit',
        'uses' => 'TeamController@getEditTeam'
    ));

    Route::post('/team-edit', array(
        'as' => 'team-edit-post',
        'uses' => 'TeamController@postEditTeam'
    ));
    ///////carna lista test////


    Route::post('/playerblacklist', array(
        'as' => 'postBlacklist',
        'uses' => 'BlacklistController@postBanPlayer'
    ));

    Route::get('/playerblacklist', array(
        'as' =>'playerBlackList',
        'uses' => 'BlacklistController@getPlayerBlacklist'
    ));
//////////////////////deleting
    //ten route jest dziwny xd, jak dam /news/{id ktorego nie ma} to wywala ze nie znalzlo sciezki do blacklisty ;p
    Route::controller('blacklist', 'BlacklistController');
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

    Route::get('/login', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));

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
    Route::get('/addGames', array(
        'as' => 'addGame',
        'uses' => 'GameController@getAddGame'
    ));

    Route::post('/addGames', array(
        'as' => 'postAddGame',
        'uses' => 'GameController@postAddGame'
    ));

});

Route::group(array('before'=>'modAuth'),function(){

});

//-------------------------------------------------
//----------------Gry test-----------------
////////////////////////////////////////////////////
Route::get('games/{gamename}', array(

    'uses' => 'GameController@getGame'

));


//-------------------------------------------------
//---------------------Testowa Galeryja------------
//-------------------------------------------------
Route::get('/ugallery', array(
    'as' => 'ugallery',
    'uses' => 'GalleryController@getGallery'
));

Route::get('/test', function(){
    return View::make('test');
});

