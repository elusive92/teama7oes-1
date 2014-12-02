<?php
class Forumcategory extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fcategories';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'title','group_id', 'author_id', 'date');
}