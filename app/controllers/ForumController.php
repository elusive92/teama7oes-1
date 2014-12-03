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

    public function storeGroup(){
        $validator = Validator::make(Input::all(),array(
            'group_name' => 'required|unique:fgroups,title'
        ));

        if($validator->fails()){
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal', '#group_form');
        }else
        {
            $group = new Forumgroup();
            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;
            $group->date = date("Y-m-d H:i:s");

            if($group->save())
            {
                return Redirect::route('forum-home')->with('success', 'The group was created.');
            }
            else
            {
                return Redirect::route('forum-home')->with('fail', 'An error occurred while saving the new group.');
            }
        }
    }
    public function deleteGroup($id)
    {
        $group = Forumgroup::find($id);
        if($group == null)
        {
            return Redirect::route('forum-home')->with('fail', 'There is no such group.');
        }
       $delGroup = $group->delete();
        if($delGroup)
        {
            return Redirect::route('forum-home')->with('success', 'The group was deleted.');
        }
        else
        {
            return Redirect::route('forum-home')->with('fail', 'Something went wrong.');
        }
    }
}