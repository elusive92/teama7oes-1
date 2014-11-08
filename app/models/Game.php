<?php

class Games extends Eloquent {

    public $timestamps = false;
    protected $table = 'games';
    protected $primaryKey = 'idgame';
    protected $fillable = array('idgame','gamename', 'descript', 'logo');

    public static  $rules = array(
        'gamename'			=> 'required|max:50|unique:games',
        'descript' 		    => 'required|min:1|max:255',
        //'logo'              => 'required|max:50|mimes:jpeg,bmp,png'

            );

    public function getGame(){
        return $this -> gamename;
    }

    public function getDescript(){
        return $this -> descript;
    }
}