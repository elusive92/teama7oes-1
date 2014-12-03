<?php

class Forumcomment extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fcomments';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'body', 'group_id', 'category_id', 'thread_id', 'author_id', 'date');

    public function group()
    {
        $this->belongsTo('Forumgroup');
    }
    public function category()
    {
        $this->belongsTo('Forumcategory');
    }
    public function thread()
    {
        $this->belongsTo('Forumthread');
    }
}