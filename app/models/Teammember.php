<?php

class Teammember extends Eloquent  {

    protected $fillable = array('id', 'idteam', 'joindate', 'leftdate');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teammembers';
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne('User', 'id', 'id');
    }
}