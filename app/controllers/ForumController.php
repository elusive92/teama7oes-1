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
        $threads = $category->threads()->get();
        return View::make('forum.category')->with('category', $category)->with('threads', $threads);
    }

    public function thread($id){
        $thread = Forumthread::find($id);
        if($thread == null)
        {
            return Redirect::route('forum-home')->with('fail', 'That threat does not exist.');
        }
        $author = $thread->author()->first()->username;
        return View::make('forum.thread')->with('thread',$thread)->with('author', $author);
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

    public function newThread($id)
    {
        return View::make('forum.newthread')->with('id', $id);
    }

    public function storeThread($id)
    {
        $category = Forumcategory::find($id);
        if($category == null)
        {
            return Redirect::route('forum-get-new-thread',$id)->with('fail', 'You posted to the invalid category.');
        }

        $validator = Validator::make(Input::all(),array(
            'title' => 'required|min:3|max:30',
            'body' => 'required|min:|max:1000'
        ));

        if($validator->fails())
        {
            return Redirect::route('forum-get-new-thread', $id)->withInput()->withErrors($validator)->with('fail', 'Your input was wrong.');
        }
        else
        {
            $thread = new Forumthread;
            $thread->title = Input::get('title');
            $thread->body = Input::get('body');
            $thread->category_id = $id;
            $thread->group_id = $category->group_id;
            $thread->author_id = Auth::user()->id;
            $category->date = date("Y-m-d H:i:s");

            if($thread->save())
            {
               return Redirect::route('forum-thread', $thread->id)->with('success', 'You thread has been saved.');
            }
            else
            {
                return Redirect::route('forum-get-new-thread',$id)->with('fail', 'Something went wrong.')->withInput();
            }

        }
    }
    public function deleteThread($id)
    {
        $thread = Forumthread::find($id);
        if($thread == null)
        {
            return Redirect::route('forum-home')->with('fail', 'En error has occurred.');
        }
        $category_id = $thread->category_id;
        if($thread->delete())
        {
            return Redirect::route('forum-category', $category_id)->with('success', 'The thread has been deleted.');
        }
        else
        {
            return Redirect::route('forum-category', $category_id)->with('fail', 'Something went wrong.');
        }
    }
    public function storeComment($id)
    {
        $thread = Forumthread::find($id);
        if($thread == null)
        {
            return Redirect::route('forum-home')->with('fail', 'That thread does not exist');
        }

        $validator = Validator::make(Input::all(),array(
            'body' => 'required|min:!'
        ));
        if($validator->fails())
        {
            return Redirect::route('forum-thread', $id)->withInput()->withErrors($validator)->with('fail', 'Please fill form correctly');
        }
        else
        {
            $comment = new Forumcomment;
            $comment->body = Input::get('body');
            $comment->author_id = Auth::user()->id;
            $comment-> group_id = $thread->group->id;
            $comment-> category_id = $thread->category->id;
            $comment->data =  date("Y-m-d H:i:s");
            $comment->thread_id = $thread->id;


            if($comment->save())
            {
                return Redirect::route('forum-thread',$id)->with('success', 'Your post has beed added.');
            }
            else
            {
                return Redirect::route('forum-thread',$id)->with('success', 'Something went wrong.');
            }
        }
    }
}