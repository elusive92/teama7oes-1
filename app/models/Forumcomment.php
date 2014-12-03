<?php

class Forumcomment extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fcomments';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'body', 'group_id', 'category_id', 'thread_id', 'author_id', 'date');

    public function group()
    {
        return $this->belongsTo('Forumgroup');
    }
    public function category()
    {
        return $this->belongsTo('Forumcategory');
    }
    public function thread()
    {
        return $this->belongsTo('Forumthread');
    }
    public function author()
    {
        return $this->belongsTo('User');
    }
}