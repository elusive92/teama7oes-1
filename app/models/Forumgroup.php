<?php

class Forumgroup extends Eloquent{

    public $timestamps = false;

    protected  $table = 'fgroups';

    protected $primaryKey = 'id';

    protected $fillable = array('id','title','author_id','date');
}