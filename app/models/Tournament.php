<?php
class Tournament extends Eloquent{

	public $timestamps = false;
	
    protected $table = 'tournaments';

    protected $primaryKey = 'id';

    protected $fillable = array('id','game_id','numberofteams','numberofplayers','name','descript','regdata','startdata','status');

}