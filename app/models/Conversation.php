<?php
class Conversation extends Eloquent{

    public $timestamps = false;

    protected $table = 'conversations';

    protected $primaryKey = 'id';

    protected $fillable = array('id','id_A','id_B');

}