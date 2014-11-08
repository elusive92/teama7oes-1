<?php
class Blacklist extends Eloquent{

    public $timestamps = false;

    protected $table = 'blacklists';

    protected $primaryKey = 'id';

    protected $fillable = array('id','id_A','id_B','date');

}