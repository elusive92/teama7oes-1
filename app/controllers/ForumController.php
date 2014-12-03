<?php

class ForumController extends BaseController{

    public function index(){
        $groups = Forumgroup::all();
        $categories = Forumcategory::all();
        return View::make('forum.forumHome')->with('groups', $groups)->with('categories', $categories);

    }
    public function category($id)
    {
        $category = Forumcategory::find($id);
        if($category == null)
        {
            return Redirect::route('form-home')->with('fail', 'There is no such category.');
        }
        $threads = $category->threads();
        return View::make('forum.category')->with('category', $category)->with('threads', $threads);
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
            $group = new Forumgroup;
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

    public function deleteCategory($id)
    {
        $category = Forumcategory::find($id);
        if($category == null)
        {
            return Redirect::route('forum-home')->with('fail', 'There is no such category.');
        }
        $delCategory = $category->delete();
        if($delCategory)
        {
            return Redirect::route('forum-home')->with('success', 'The category was deleted.');
        }
        else
        {
            return Redirect::route('forum-home')->with('fail', 'Something went wrong.');
        }
    }

    public function storeCategory($id)
    {
        $validator = Validator::make(Input::all(),array(
            'category_name' => 'required|unique:fcategories,title'
        ));

        if($validator->fails()){
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('category-modal', '#category_modal')->with('group-id', $id);
        }else
        {
            $group = Forumgroup::find($id);
            if($group == null)
            {
                return Redirect('forum-home')->with('fail', 'There is no such group.');
            }

            $category = new Forumcategory;
            $category->title = Input::get('category_name');
            $category->author_id = Auth::user()->id;
            $category->date = date("Y-m-d H:i:s");
            $category->group_id = $id;

            if($category->save())
            {
                return Redirect::route('forum-home')->with('success', 'The category was created.');
            }
            else
            {
                return Redirect::route('forum-home')->with('fail', 'An error occurred while saving the new group.');
            }
        }

    }
}