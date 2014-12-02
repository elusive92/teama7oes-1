<?php

class NewsController extends BaseController {
    

    public function postNews(){

        $validator = Validator::make(
            array(
                'title' => Input::get('title'),
                'descript' => Input::get('descript'),
                'draft' => Input::get('draft'),
                //'photo' => Input::get('photo'),
            ),
            array(
                'title' => 'required|min:4|max:80',
                'descript' => 'required|max:3000',
                'draft' => 'required',
               // 'photo' => 'required',
            )
        );

        if($validator->fails()){
            return Redirect::route('home')
                ->withErrors($validator);
        }else{
            $title = Input::get('title');
            $descript = Input::get('descript');
            $draft   =  Input::get('draft');
            $photo   =  Input::file('photo');
            $game_id = 1;
            
            $extension = Input::file('photo');
            $destinationPath = 'img/ico/';

            $news   = News::create(array(
                'title' => $title,
                'descript' => $descript,
                'draft' => $draft,
                'photo' => $photo,
                'game_id' => $game_id
            ));
            if($news){
                return Redirect::route('home')
                    ->with('message', 'Your news has been added');
                    }   
            
        }}

    public function deleteNews($id){
        // $news = News::where('id', '=', $id)->firstOrFail();
        // var_dump("deleting $news ");

        $news = News::find($id);
        $dstr = $news->delete();

        if($dstr){
            return Redirect::route('home')
                ->with('message', 'Your news has been deleted');
        }

    }

    public function editNews($id){

        $news = News::findOrFail($id);

        // var_dump("edit $news ");
       // return View::make('news.edit')->withNews('news', $news);       
        return View::make('news.edit', compact('news'));

    }

    public function updateNews(){
        $validator = Validator::make(
            array(
                'title' => Input::get('title'),
                'descript' => Input::get('descript'),
                'draft' => Input::get('draft'),
            ),
            array(
                'title'  => 'min:5',
                'descript'  => 'min:5',
                'draft' => 'required',
            )
        );    

        if($validator->fails()){
            return Redirect::route('home')
                ->withErrors($validator);
        }else{

            $title = Input::get('title');
            $descript = Input::get('descript');
            $draft   =  Input::get('draft');
            $game_id = 1;
            $id = Input::get('newsid');
            $news = News::where('id', '=', $id)->first();

            if($title){$news->title = Input::get('title');}     
            if($descript){$news->descript = Input::get('descript');}
            if($draft){$news->draft = Input::get('draft');}           
            $news->save();  

            if($news->save()){
            
                return Redirect::route('home')->with('message', 'Your news has been updated');
            }

    }}

    public function manageNews(){

        $news = News::where('draft', '=', 1)
        ->orderBy('created_at', 'desc')
        ->get();


        
        return View::make('news.manage')->with('news', $news);

    }

}