<?php

class Forumgroup extends Eloquent{

    public $timestamps = false;

    protected  $table = 'fgroups';

    protected $primaryKey = 'id';

    protected $fillable = array('id','title','author_id','date');

    public function categories()
    {
        return $this->hasMany('Forumcategory', 'group_id');
    }
    public function threads()
    {
        return $this->hasMany('Forumthread', 'group_id');
    }
    public function comments()
    {
        return $this->hasMany('Forumcomment', 'group_id');
    }
}