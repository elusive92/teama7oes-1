<?php

class ForumController extends BaseController{

    public function index(){
        $groups = Forumgroup::all();
        $categories = Forumcategory::all();
        return View::make('forum.forumHome')->with('groups', $groups)->with('categories', $categories);

    }
    public function group($id){

    }

    public function thread($id){

    }
}