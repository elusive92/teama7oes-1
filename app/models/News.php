<?php 

class News extends Eloquent {


    protected $table = 'news';

    protected $primaryKey = 'id';

    protected $fillable = array('id','game_id','title','descript', 'photo', 'draft', 'created_at', 'updated_at');


}