<?php
class Blacklist extends Eloquent{

    public $timestamps = false;

    protected $table = 'blacklists';

    protected $primaryKey = 'idblock';

    protected $fillable = array('idblock','idA','idB','date');

}