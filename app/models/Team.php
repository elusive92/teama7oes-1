<?php

class Team extends Eloquent
{


    protected $fillable = array('id_users', 'id_teams', 'teamname', 'logo', 'ranking', 'win', 'lose', 'updated_at', 'created_at');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teams';
    protected $primaryKey = 'id';

}