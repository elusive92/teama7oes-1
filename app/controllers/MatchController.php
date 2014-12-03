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
                    return View::make('tournament.test')->with('matches', $matches);
                }


            }



        }
        $matches = Match::where('tournament_id', '=', $tournamentId)
            ->get();
        return View::make('tournament.test')->with('matches', $matches);
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
                if($games['home'] != 'byweek' && $games['away'] != 'byweek'){
                    $allgames[] = $games;
                }
            }
        }

        foreach($allgames as $game){
            Match::create(array(
                'tournament_id' => $tournamentId,
                'id_teamsA' => $game['home'],
                'id_teamsB' => $game['away']
            ));
        }

        return View::make('tournament.test');
    }

    public function postResult($result){
        $k = 25;
        $teamA = Input::get('teamA');
        $teamB = Input::get('teamB');
        $tournamentId = Input::get('tournamentId');
        $match = Match::where('id_teamsA', '=', $teamA)
            ->where('id_teamsB', '=', $teamB)
            ->where('tournament_id', '=', $tournamentId)
            ->first();
        if($match){
            $Ra = $match->teamA->ranking;
            $Rb = $match->teamB->ranking;
            $Pa = 1 / (1 + pow(10 , (($Rb - $Ra) / 400)));
            $Pb = 1 / (1 + pow(10 , (($Ra - $Rb) / 400)));
            if($result == 1){
                $match->teamA->ranking += round($k * $Pb);
                $match->teamB->ranking -= round($k * $Pb);
                $match->teamA->win += 1;
                $match->teamB->lose += 1;
            }elseif($result == 2){
                $match->teamA->ranking -= round($k * $Pa);
                $match->teamB->ranking += round($k * $Pa);
                $match->teamB->win += 1;
                $match->teamA->lose += 1;
            }
            $match->save();
        }

    }

    public function getResults($tournamentId){

    }
}
