<?php

class Teaminvitation extends Eloquent  {

    protected $fillable = array('id', 'team_id', 'user_id', 'date');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teaminvitations';
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

}