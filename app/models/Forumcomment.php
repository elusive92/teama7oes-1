<?php

class Forumcomment extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fcomments';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'body', 'group_id', 'category_id', 'thread_id', 'author_id', 'date');
}