<?php

class MatchController extends BaseController {

    public function getMatches($tournamentId){
        if(Auth::check()){
            $team = Team::where('user_id', '=', Auth::user()->id)
                ->where('game_id', '=', Cookie::get('gameid'))
                ->first();
            if($team){
                $member = Tournamentmember::where('tournament_id', '=', $tournamentId)
                    ->where('team_id', '=', $team->id)
                    ->first();
                if($member){
                    $matches = Match::where('tournament_id', '=', $tournamentId)
                        ->whereExists(function($query){
                            $query->select(DB::raw(1))
                                ->from('teams')
                                ->whereRaw('teams.user_id = '.Auth::user()->id.'')
                                //->whereRaw('teams.game_id = 2')
                                ->whereRaw('(teams.id = matches.id_teamsA AND teams.game_id = '.Cookie::get('gameid').') or (teams.id = matches.id_teamsB AND teams.game_id = '.Cookie::get('gameid').')');
                                //->orWhereRaw('teams.id = matches.id_teamsB');
                        })
                        ->get();
                    if(Auth::user()->permissions > 0){
                        $conflicts = Match::where('matches.tournament_id', '=', $tournamentId)
                            //->where('matches.resultA', '<>', 'matches.resultB')
                            ->where('matches.resultB', '<>', 'matches.resultA')
                            //->orWhere('matches.resultB', '<>', 'matches.resultA')
                            //->where('matches.result', '=', 0)
                            ->where('matches.result', '=', 0)
                            ->get();
                        $conflicts1 = Match::where('matches.tournament_id', '=', $tournamentId)
                            ->where('matches.resultA', '<>', 'matches.resultB')
                            ->where('matches.result', '=', 0)
                            ->get();

//                        $conflicts = DB::table('matches')
//                            ->where('matches.resultA', '<>', 'matches.resultB')
//                            ->where('matches.result', '<>', 0)
//                            ->get();

                        return View::make('tournament.test')
                            ->with('matches', $matches)
                            ->with('conflicts', $conflicts)
                            ->with('conflicts1', $conflicts1);
                    }else{
                        return View::make('tournament.test')
                            ->with('matches', $matches)
                            ->with('conflicts', false)
                            ->with('conflicts1', false);
                    }

                }


            }



        }

        $matches = Match::where('tournament_id', '=', $tournamentId)
            ->get();
        if(Auth::user()->permissions > 0){
//            $conflicts = Match::where('tournament_id', '=', $tournamentId)
//                ->whereExists(function($query){
//                    $query->select(DB::raw(1))
//                        ->from('matches')
//                        ->whereRaw('(matches.resultA <> matches.resultB) AND (matches.resultA <> 0) AND (matches.resultB <> 0) AND (matches.result = 0)');
//                })
//                ->get();
//
//            return View::make('tournament.test')
//                ->with('matches', $matches)
//                ->with('conflicts', $conflicts);
        }else{
            return View::make('tournament.test')
                ->with('matches', $matches)
                ->with('conflicts', false);
        }

    }

    public function settingMatches($tournamentId){

        $tournamentMembers = Tournamentmember::where('tournament_id', '=', $tournamentId)
            ->get();
        $gamearr = array();
        $tempgamearr = array();
        foreach($tournamentMembers as $tournamentMember){
            $gamearr[] = $tournamentMember->team->id;
            $tempgamearr[] = $tournamentMember->team->id;
        }

        $gamenumperteam = 7;
        $numteamspadded = count($gamearr);

        if(!($numteamspadded % 2 == 0)){
            $gamearr[$numteamspadded] = 'FREE-POINT';
            $tempgamearr[$numteamspadded] = 'FREE-POINT';
            $numteamspadded += 1;
        }
        //die(var_dump($gamearr));

        $bottom = $numteamspadded-1;
        $half = $numteamspadded/2;

        $firsteam = $gamearr[0];
        for($i=0; $i<$gamenumperteam; $i++){
            for($j=0; $j<$half; $j++){
                if($numteamspadded==4)
                    $rrarr[$i][$j]['home'] = $tempgamearr[$j];
                else $rrarr[$i][$j]['home'] = $gamearr[$j];
                $rrarr[$i][$j]['away'] = $gamearr[$bottom-$j];
            }

            for($j=1; $j<=$bottom+1; $j++){
                $start = ($i+$j)%$numteamspadded;
                $gamearr[$j-1] = $tempgamearr[$start];
            }

            array_splice($gamearr, array_search($firsteam, $gamearr), 1);
            foreach($gamearr as $key=>$val){
                if($tempgamearr[$bottom-$key] == $val){
                    $TempGameValue = $val;
                    $switch = $key;
                }
            }

            $gamearr[$bottom] = $TempGameValue;
            $gamearr[$switch] = $firsteam;
        }
        foreach($rrarr as $key=>$val){
            foreach($val as $gkey=>$games){
//                if($games['home'] != 'FREE-POINT' && $games['away'] != 'FREE-POINT'){
                    $allgames[] = $games;
//                }
            }
        }

        foreach($allgames as $game){
            if($game['home'] == 'FREE-POINT' && $game['away'] != 'FREE-POINT'){
                Match::create(array(
                    'tournament_id' => $tournamentId,
                    //'id_teamsA' => $game['home'],
                    'id_teamsB' => $game['away'],
                    'result' => 2
                ));
            }elseif($game['home'] != 'FREE-POINT' && $game['away'] == 'FREE-POINT'){
                Match::create(array(
                    'tournament_id' => $tournamentId,
                    'id_teamsA' => $game['home'],
                    //'id_teamsB' => $game['away'],
                    'result' => 1
                ));
            }elseif($games['home'] != 'FREE-POINT' && $games['away'] != 'FREE-POINT'){
                Match::create(array(
                    'tournament_id' => $tournamentId,
                    'id_teamsA' => $game['home'],
                    'id_teamsB' => $game['away']
                ));
            }
        }

        $tournament = Tournament::where('id', '=', $tournamentId)->first();
        $tournament->status = 2;
        $tournament->save();

        return Redirect::route('tournament-show', array('id' => $tournamentId));
    }

    public function postResult($tournamentId, $result, $teamA, $teamB){
        $k = 25;
//        $teamA = Input::get('teamA');
//        $teamB = Input::get('teamB');
//        $tournamentId = Input::get('tournamentId');
        $match = Match::where('id_teamsA', '=', $teamA)
            ->where('id_teamsB', '=', $teamB)
            ->where('tournament_id', '=', $tournamentId)
            ->first();
        $teamA = Team::where('id', '=', $teamA)->first();
        $teamB = Team::where('id', '=', $teamB)->first();
        if($match){
            $Ra = $teamA->ranking;
            $Rb = $teamB->ranking;
            $Pa = 1 / (1 + pow(10 , (($Rb - $Ra) / 400)));
            $Pb = 1 / (1 + pow(10 , (($Ra - $Rb) / 400)));
            if($result == 1){
                $teamA->ranking += round($k * $Pb);
                $teamB->ranking -= round($k * $Pb);
                $teamA->win += 1;
                $teamB->lose += 1;
            }elseif($result == 2){
                $teamA->ranking -= round($k * $Pa);
                $teamB->ranking += round($k * $Pa);
                $teamB->win += 1;
                $teamA->lose += 1;
            }
            $teamA->save();
            $teamB->save();
            $match->save();
            return Redirect::route('tournament-show', array('id' => $match->tournament_id));
        }

    }

    public function getMatchResult($matchid){
        if(Auth::check()){
            $match = Match::where('id', '=', $matchid)->first();

            if((Auth::user()->id && $match->teamA->user_id) || (Auth::user()->id && $match->teamB->user_id)){
                return View::make('tournament.matchResult')
                    ->with('match', $match);
            }
        }

    }

    public function getMatchResultMod($matchid){
        if(Auth::check()){
            if(Auth::user()->permissions > 0){
                $match = Match::where('id', '=', $matchid)->first();
                    return View::make('tournament.modResult')
                        ->with('match', $match);
            }

        }

    }

    public function postMatchResultA(){
        $matchId = Input::get('matchId');
        $match = Match::where('id', '=', $matchId)->first();
        if(Auth::check()){
            if(Auth::user()->id == $match->teamA->user_id){
                $match->resultA = 1;
                if($match->resultB == 1){
                    $match->result = 1;
                    $match->save();
                    return Redirect::route('postResult', array(
                        'tournamentId' => $match->tournament_id,
                        'result' => 1,
                        'teamA' => $match->teamA->id,
                        'teamB' => $match->teamB->id
                    ));
                }else{
                    $match->save();
                    return Redirect::route('tournament-show', array('id' => $match->tournament_id));
                }
            }elseif(Auth::user()->id == $match->teamB->user_id){
                $match->resultB = 1;
                if($match->resultA == 1){
                    $match->result = 1;
                    $match->save();
                    return Redirect::route('postResult', array(
                        'tournamentId' => $match->tournament_id,
                        'result' => 1,
                        'teamA' => $match->teamA->id,
                        'teamB' => $match->teamB->id
                    ));
                }else{
                    $match->save();
                    return Redirect::route('tournament-show', array('id' => $match->tournament_id));
                }
            }
        }
    }

    public function postMatchResultB(){
        $matchId = Input::get('matchId');
        $match = Match::where('id', '=', $matchId)->first();
        if(Auth::check()){
            if(Auth::user()->id == $match->teamA->user_id){
                $match->resultA = 2;
                if($match->resultB == 2){
                    $match->result = 2;
                    $match->save();
                    return Redirect::route('postResult', array(
                        'tournamentId' => $match->tournament_id,
                        'result' => 2,
                        'teamA' => $match->teamA->id,
                        'teamB' => $match->teamB->id
                    ));
                }else{
                    $match->save();
                    return Redirect::route('tournament-show', array('id' => $match->tournament_id));
                }
            }elseif(Auth::user()->id == $match->teamB->user_id){
                $match->resultB = 2;
                if($match->resultA == 2){
                    $match->result = 2;
                    $match->save();
                    return Redirect::route('postResult', array(
                        'tournamentId' => $match->tournament_id,
                        'result' => 2,
                        'teamA' => $match->teamA->id,
                        'teamB' => $match->teamB->id
                    ));
                }else{
                    $match->save();
                    return Redirect::route('tournament-show', array('id' => $match->tournament_id));
                }
            }
        }
    }

    public function postMatchResultModA()
    {
        $matchId = Input::get('matchId');

        if (Auth::check()) {
            if (Auth::user()->permissions > 0) {
                $match = Match::where('id', '=', $matchId)->first();
                $match->result = 1;
                $match->resultA = 3;
                $match->resultB = 3;
                $match->save();
                return Redirect::route('postResult', array(
                    'tournamentId' => $match->tournament_id,
                    'result' => 1,
                    'teamA' => $match->teamA->id,
                    'teamB' => $match->teamB->id
                ));
            }
        }
    }
    public function postMatchResultModB()
    {
        $matchId = Input::get('matchId');
        $match = Match::where('id', '=', $matchId)->first();
        if (Auth::check()) {
            if (Auth::user()->permissions > 0) {
                $match = Match::where('id', '=', $matchId)->first();
                $match->result = 2;
                $match->resultA = 3;
                $match->resultB = 3;
                $match->save();
                return Redirect::route('postResult', array(
                    'tournamentId' => $match->tournament_id,
                    'result' => 2,
                    'teamA' => $match->teamA->id,
                    'teamB' => $match->teamB->id
                ));
            }
        }
    }

}
