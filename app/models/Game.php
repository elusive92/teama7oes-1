<?php

class Game extends Eloquent {

    public $timestamps = false;
    protected $table = 'games';
    protected $primaryKey = 'id';
    protected $fillable = array('id','gamename', 'descript', 'logo');

    public static  $rules = array(
        'gamename'			=> 'required|max:50|unique:games',
        'descript' 		    => 'required|min:1|max:255',
        //'logo'              => 'required|max:50|mimes:jpeg,bmp,png'

            );


}