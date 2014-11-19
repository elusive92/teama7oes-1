<?php
class Message extends Eloquent{

    public $timestamps = false;

    protected $table = 'messages';

    protected $primaryKey = 'id';

    protected $fillable = array('id','conversation_id','user_id','senddate', 'recivedate');

}