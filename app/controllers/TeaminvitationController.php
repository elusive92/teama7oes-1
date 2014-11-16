<?php

class TeaminvitationController extends BaseController {

    public function postTeamInv(){
        $validator = Validator::make(
            array(
                'name' => Input::get('name')
            ),
            array(
                'name' => 'required'
            )
        );
        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $user = User::where('username', '=', Input::get('name'))
            ->first();
        
        if($user){
            if(($user->id) == (Auth::user()->id)){
                return Response::json([
                    'success' => false,
                    'error' => array('error' => 'You cant add yourself.'),
                    'redirect' => Redirect::intended('/')
                ]);
            }
            $team = Team::where('user_id', '=', Auth::user()->id)
                //->where('game_id', '=', $gameid)
                ->first();
            $teammembers = Teammember::where('user_id', '=', $user->id)
                ->whereNull('leftdate')
                ->get();
            foreach($teammembers as $teammember){
                $team2 = Team::where('id', '=', $teammember->team_id)
                    ->first();
                if(($team->game_id) == ($team2->game_id)){
                    return Response::json([
                        'success' => false,
                        'error' => array('error' => 'User already have a team.'),
                        'redirect' => Redirect::intended('/')
                    ]);
                }
            }
            $teaminv = Teaminvitation::where('user_id', '=', $user->id)
                ->where('team_id', '=', $team->id);
            if(!($teaminv->first())){
                $teaminv = Teaminvitation::create(array(
                    'user_id'       => $user->id,
                    'team_id'       => $team->id,
                    'date'      => date("Y-m-d H:i:s")
                ));
                if ($teaminv) {
                    return Response::json(['success' => true]);
                } else {
                    return Response::json([
                        'success' => false,
                        'error' => array('error' => 'Something went wrong.'),
                        'redirect' => Redirect::intended('/')
                    ]);

                }
            }else{
                return Response::json([
                    'success' => false,
                    'error' => array('error' => 'You have already invited this player.'),
                    'redirect' => Redirect::intended('/')
                ]);
            }
        }else{
            return Response::json([
                'success' => false,
                'error' => array('error' => 'User with this username does not exists.'),
                'redirect' => Redirect::intended('/')
            ]);
        }

    }

    public function delTeamInv(){
        $teaminv = Teaminvitation::find(Input::get('id'));
        if($teaminv->delete()){
            return Redirect::action('TeamController@getEditTeam');
        }
    }

    public function accInv(){
        $teaminv = Teaminvitation::find(Input::get('id'));
        $teammember = Teammember::create(array(
            'user_id'     => $teaminv->user_id,
            'team_id' => $teaminv->team_id,
            'joindate' => date("Y-m-d H:i:s")
        ));
        if($teammember) {
            $teaminv->delete();
            return Redirect::action('TeamController@myTeam');
        }
    }

    public function decInv(){
        $teaminv = Teaminvitation::find(Input::get('id'));
        if($teaminv->delete()){
            return Redirect::action('TeamController@myTeam');
        }
    }
}