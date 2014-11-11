<?php

class Teaminvitation extends Eloquent  {

    protected $fillable = array('idinv', 'idteam', 'id', 'date');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teaminvitations';
    protected $primaryKey = 'idinv';
    public $timestamps = false;

}