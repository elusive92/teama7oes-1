<?php
class Gallery extends Eloquent{

    public $timestamps = false;

    protected $table = 'teamgalleries';

    protected $fillable = array('id','team_id', 'title', 'descript', 'filename', 'date');

    public function teamLeader(){
        return $this->hasOne('Team', 'id', 'team_id');
    }

}