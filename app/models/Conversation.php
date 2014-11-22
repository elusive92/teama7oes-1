<?php
class Conversation extends Eloquent{

    public $timestamps = false;

    protected $table = 'conversations';

    protected $primaryKey = 'id';

    protected $fillable = array('id','id_A','id_B', 'last_activity', 'unreaded');

    public function messages(){
        return $this->hasMany('Message');
    }
    public function userA()
    {
        return $this->hasOne('User', 'id', 'id_A');
    }
    public function userB()
    {
        return $this->hasOne('User', 'id', 'id_B');
    }

}