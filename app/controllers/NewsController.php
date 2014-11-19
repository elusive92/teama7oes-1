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
            $title = Input::get('title');
            $descript = Input::get('descript');
            $draft   =  Input::get('draft');
            $game_id = 1;
            
            $news   = News::create(array(
                'title' => $title,
                'descript' => $descript,
                'draft' => $draft,
                'game_id' => $game_id
            ));
            if($news){
                return Redirect::route('home')
                    ->with('message', 'Your news has been added');
                    }   
            
        }

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
            $news = Input::get('id');
            $title = Input::get('title');
            $descript = Input::get('descript');
            $draft   =  Input::get('draft');
            $game_id = 1;
            
            News::where('id', $news)->update(array(

            'title' => $title,
            'descript' => $descript,
            'draft' => $draft,
            'game_id' => $game_id
            ));
            
                return Redirect::route('home')->with('message', 'Your news has been updated');
            

    }

    public function manageNews(){

        $news = News::where('draft', '=', 1)
        ->orderBy('created_at', 'desc')
        ->get();


        
        return View::make('news.manage')->with('news', $news);

    }

}