<?php
class Gallery extends Eloquent{

    public $timestamps = false;

    protected $table = 'galleries';

    protected $fillable = array('id', 'title', 'descript', 'filename', 'date');

}