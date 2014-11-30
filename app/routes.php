<?php



Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@showHome'
));

Route::get('/news/{id}', array(
    'as' => 'news-show',
    'uses' => 'HomeController@showNews'
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

Route::get('/tournament/{id}', array(
    'as' => 'tournament-show',
    'uses' => 'TournamentController@showTournament'
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

    //////Tournament
    Route::post('/tournament-create', array(
        'as' => 'tournament-create-post',
        'uses' => 'TournamentController@createTournament'
    ));


    Route::get('/tournament-manage', array(
        'as' => 'manage-tournament',
        'uses' => 'TournamentController@manageTournament'
    ));

    Route::get('/tournament-add', array(
    'as' => 'tournament-add',
    'uses' => 'TournamentController@addTournament'
    ));
    

    Route::get('/account-sign-in', array(
        'as' => 'account-sign-in',
        'uses' => 'HomeController@showHome'
    ));

    Route::get('/account-create', array(
        'as' => 'account-create',
        'uses' => 'HomeController@showHome'
    ));

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

    //////////friend list//////////////

    Route::post('/playerfriendlist', array(
        'as' => 'postFriendlist',
        'uses' => 'FriendlistController@postFriendPlayer'
    ));

    Route::get('/playerfriendlist', array(
        'as' =>'friendlistPlayer',
        'uses' => 'FriendlistController@getPlayerFriendlist'
    ));
    

    Route::post('/addPlayer', array(
        'as' => 'team-add-player',
        'uses' => 'TeaminvitationController@postTeamInv'
    ));

    Route::post('/delPlayerInv', array(
        'as' => 'team-del-inv-player',
        'uses' => 'TeaminvitationController@delTeamInv'
    ));

    Route::post('/delPlayer', array(
        'as' => 'team-del-player',
        'uses' => 'TeamController@TeamKickPlayer'
    ));

    Route::post('/accInv', array(
        'as' => 'team-acc-inv',
        'uses' => 'TeaminvitationController@accInv'
    ));

    Route::post('/decInv', array(
        'as' => 'team-dec-inv',
        'uses' => 'TeaminvitationController@decInv'
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

    Route::delete('/playerblacklist', array(
        'as' => 'delPlayer',
        'uses' => 'BlacklistController@delPlayerB'
    ));

    Route::get('/inbox', array(
        'as' => 'getInbox',
        'uses' => 'ConversationController@getInbox'
    ));

    Route::get('/conversation', array(
        'as' => 'getConversation',
        'uses' => 'ConversationController@getConversation'
    ));

    Route::get('/messages', array(
        'as' => 'getMessages',
        'uses' => 'ConversationController@getMessages'
    ));

    Route::post('/sendMessage', array(
        'as' => 'sendMessage',
        'uses' => 'ConversationController@sendMessage'
    ));

    Route::post('/addConvs', array(
        'as' => 'addConvs',
        'uses' => 'ConversationController@addConvs'
    ));

    Route::get('/friendConvs', array(
        'as' => 'friendConvs',
        'uses' => 'ConversationController@friendList'
    ));

    Route::get('/otherConvs', array(
        'as' => 'otherConvs',
        'uses' => 'ConversationController@otherList'
    ));

//////////////////////deleting
    //ten route jest dziwny xd, jak dam /news/{id ktorego nie ma} to wywala ze nie znalzlo sciezki do blacklisty ;p
    // Route::controller('blacklist', 'BlacklistController');
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

        Route::post('/create', array(
            'as' => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));

        Route::post('/create2', array(
            'as' => 'account-create-post2',
            'uses' => 'AccountController@postCreate2'
        ));

        Route::post('/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));
        Route::post('/sign-in2', array(
            'as' => 'account-sign-in-post2',
            'uses' => 'AccountController@postSignIn2'
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

    Route::get('/sign-in', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));

    Route::get('/create', array(
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

Route::group(array('before'=>'adminAuth'), function()
{

    Route::get('/addGames', array(
        'as' => 'addGame',
        'uses' => 'GameController@getAddGame'
    ));

    Route::post('/addGames', array(
        'as' => 'postAddGame',
        'uses' => 'GameController@postAddGame'
    ));

    Route::get('/gameslist', array(
        'as' => 'edit-game',
        'uses' => 'GameController@getAllEditGames'

    ));
    Route::post('/gameslist', array(
        'as' => 'delGame',
        'uses' => 'GameController@postDeleteGame'

    ));
    Route::get('/editgame/{gameid?}', array(
        'as' => 'edit-game-one',
        'uses' => 'GameController@getEditGame'

    ));
    Route::post('/editgame/{gameid?}', array(
        'as' => 'edit-game-post',
        'uses' => 'GameController@postEditGame'

    ));


    //NEWSY
Route::get('/news-add', array(
    'as' => 'news-add',
    'uses' => 'HomeController@addNews'
));

 Route::post('/news-add', array(
    'as' => 'news-add-post',
    'uses' => 'NewsController@postNews'
));

Route::get('/news-edit/{id}', array(
    'as' => 'news-edit',
    'uses' => 'NewsController@editNews'
));

Route::post('/news-edit/update', array(
    'as' => 'news-update',
    'uses' => 'NewsController@updateNews'
));

Route::get('/news-delete/{id}', array(
    'as' => 'news-delete',
    'uses' => 'NewsController@deleteNews'
));

Route::get('/manage-news', array(
    'as' => 'manage-news',
    'uses' => 'NewsController@manageNews'
));


});

Route::group(array('before'=>'modAuth'),function(){

// Newsy tylko dla moderatora    
Route::get('/news-add', array(
    'as' => 'news-add',
    'uses' => 'HomeController@addNews'
));

 Route::post('/news-add', array(
    'as' => 'news-add-post',
    'uses' => 'NewsController@postNews'
));

Route::get('/news-edit/{id}', array(
    'as' => 'news-edit',
    'uses' => 'NewsController@editNews'
));

Route::post('/news-edit/update', array(
    'as' => 'news-update',
    'uses' => 'NewsController@updateNews'
));

Route::get('/news-delete/{id}', array(
    'as' => 'news-delete',
    'uses' => 'NewsController@deleteNews'
));

Route::get('/manage-news', array(
    'as' => 'manage-news',
    'uses' => 'NewsController@manageNews'
));

});

//-------------------------------------------------
//----------------Gry test-----------------
////////////////////////////////////////////////////
Route::post('/games', array(
    'as' => 'postGame',
    'uses' => 'GameController@postGameId'

));

Route::get('/games', array(
    'as' => 'getGame2',
    'uses' => 'GameController@getDaGame'

));
Route::get('/gamesView', array(
    'as' => 'gameView',
    'uses' => 'GameController@getAllGamesView'

));

Route::get('/allhome', array(
    'as' => 'gohome',
    'uses' => 'GameController@getshowHome'));

Route::get('/allhomego', array(
    'as' => 'gohome1',
    'uses' => 'GameController@gethome'));

//-------------------------------------------------
//---------------------Testowa Galeryja------------
//-------------------------------------------------
Route::get('/ugallery/{username?}', array(
    'as' => 'ugallery',
    'uses' => 'GalleryController@getGallery'
));

Route::post('/ugallery/{username?}', array(
    'as' => 'ugalleryPost',
    'uses' => 'GalleryController@postAddPicture'
));

/*test resizera */
Route::post('upload', function()
{
    //var_dump($image=Input::file('image'));
    $image = Input::file('image');

    //var_dump($image->getRealPath());
    $filename = $image->getClientOriginalName();

    if(Image::make($image->getRealPath())->resize('200', '200')->save('img/resizer/'. $filename)){
        return 'dziala';
    }


});
/* */