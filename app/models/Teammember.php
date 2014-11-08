<?php

class Teammember extends Eloquent  {

    protected $fillable = array('id_users', 'id_teams', 'joindate', 'leftdate');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teammembers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne('User', 'id', 'id');
    }
}