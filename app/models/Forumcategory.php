<?php
class Forumcategory extends Eloquent
{

    public $timestamps = false;

    protected $table = 'fcategories';

    protected $primaryKey = 'id';

    protected $fillable = array('id', 'title','group_id', 'author_id', 'date');

    public function group()
    {
        $this->belongsTo('Forumgroup');
    }
    public function threads()
    {
        return $this->hasMany('Forumthread', 'category_id');
    }
    public function comments()
    {
        return $this->hasMany('Forumcomment', 'category_id');
    }
}