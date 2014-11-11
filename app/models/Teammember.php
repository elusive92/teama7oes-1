<?php

class Teammember extends Eloquent  {

    protected $fillable = array('user_id', 'team_id', 'joindate', 'leftdate');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teammembers';
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne('User', 'user_id', 'id');
    }
}