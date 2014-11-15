<?php

class NewsController extends BaseController {
    

    public function postNews(){

        // $validator = Validator::make(
        //     array(
        //         'title' => Input::get('name'),
        //         'descript' => Input::get('message'),
        //         'selection' => Input::get('selection'),
        //     ),
        //     array(
        //         'title' => 'required|min:4|max:80',
        //         'descript' => 'required|max:3000',
        //         'selection' => 'required'
        //     )
        // );

        // if($validator->fails()){
        //     return Redirect::route('home')
        //         ->withErrors($validator);
        // }else{
            $title = Input::get('name');
            $descript = Input::get('message');
            $draft   =  Input::get('selection');
            $game_id = 1;
            
            $news   = News::create(array(
                'title' => $title,
                'descript' => $descript,
                'draft' => $draft,
                'game_id' => $game_id
            ));
            if($news){
                return Redirect::route('home')
                    ->with('message', 'Your news has been create');
                    }   
            
        }

    public function deleteNews($id){
        // $news = News::where('id', '=', $id)->firstOrFail();
        // var_dump("deleting $news ");

        $news = News::find($id);
        $dstr = $news->delete();

        if($dstr){
            return Redirect::route('home')
                ->with('message', 'usuneiteo usuneiteo usuneiteo usuneiteo usuneiteo usuneiteo ');
        }

    }

    public function editNews($id){

        $news = News::find($id);

        // var_dump("edit $news ");
        return View::make('news.edit')->with('news', $news);       
        

    }

    public function manageNews(){

        $news = News::where('draft', '=', 1)
        ->orderBy('created_at', 'desc')
        ->get();


        
        return View::make('home')->with('news', $news);

    }

}