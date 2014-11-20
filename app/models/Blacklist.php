<?php
class Blacklist extends Eloquent{

    public $timestamps = false;

    protected $table = 'blacklists';

    protected $primaryKey = 'id';

    protected $fillable = array('id','id_A','id_B','date');

    public function user()
    {
        return $this->hasOne('User', 'id', 'id_B');
    }
}