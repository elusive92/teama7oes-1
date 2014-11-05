<?php
class Blacklist extends Eloquent{

    public $timestamps = false;

    protected $table = 'blacklists';

    $primaryKey = idblock;

    protected $fillable = array('idblock','idA','idB','date');

}