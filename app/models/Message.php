<?php
class Message extends Eloquent{

    public $timestamps = false;

    protected $table = 'messages';

    protected $primaryKey = 'id';

    protected $fillable = array('id','conversation_id','user_id', 'text', 'senddate');

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

}