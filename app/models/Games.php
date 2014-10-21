<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2014-10-21
 * Time: 07:53
 */
class Games extends Eloquent {

    protected $table = "games";
    protected $fillable = array('gamename', "descript", "logo");

    public function getGame(){
        return $this -> gamename;
    }

    public function getDescript(){
        return $this -> descript;
    }
}