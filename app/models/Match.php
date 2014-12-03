<?php

class Match extends Eloquent  {

    protected $fillable = array('id', 'tournament_id', 'id_teamsA', 'id_teamsB', 'date', 'result', 'round', 'bracket', 'resultA', 'resultB');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'matches';
    public $timestamps = false;    

    public function teamA(){
        return $this->hasOne('Team', 'id', 'id_teamsA');
    }
    public function teamB(){
        return $this->hasOne('Team', 'id', 'id_teamsB');
    }
}