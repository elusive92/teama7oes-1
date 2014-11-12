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
            $team = Team::where('user_id', '=', Auth::user()->id)
                //->where('game_id', '=', $gameid)
                ->first();
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

    public function acceptTeamInv(){

    }

    public function declineTeamInv(){

    }
}