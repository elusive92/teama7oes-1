<?php

class Forumthread extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fthreads';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'title', 'body', 'group_id', 'category_id', 'author_id', 'date');

    public function group()
    {
        $this->belongsTo('Forumgroup');
    }

    public function category()
    {
        $this->belongsTo('Forumcategory');
    }


    public function comments()
    {
        return $this->hasMany('Forumcategory', 'thread_id');
    }
}