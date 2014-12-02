<?php

class Tournamentmember extends Eloquent  {

    protected $fillable = array('id', 'tournament_id', 'team_id', 'position');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tournamentmembers';
    public $timestamps = false;    

    public function team(){
        return $this->hasOne('Team', 'id', 'team_id');
    }
}