<?php

class Forumthread extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fthreads';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'title', 'body', 'group_id', 'category_id', 'author_id', 'date');

    public function group()
    {
        return $this->belongsTo('Forumgroup');
    }

    public function category()
    {
        return $this->belongsTo('Forumcategory','category_id');
    }


    public function comments()
    {
        return $this->hasMany('Forumcomment', 'thread_id');
    }

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }
}