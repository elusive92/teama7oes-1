<?php
class Friendlist extends Eloquent{


    protected $table = 'friendlist';

    protected $primaryKey = 'id';

    protected $fillable = array('id','id_adding','id_friend','date');

}