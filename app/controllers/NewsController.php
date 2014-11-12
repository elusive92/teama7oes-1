<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2014-10-19
 * Time: 08:44
 */
//** User controller */

class NewsController extends BaseController {
    

//////////////////////////WYSWIETLANIE PROFILU/////////////////////////////////////////

    public function postNews(){

        $validator = Validator::make(
            array(
                'title' => Input::get('name'),
                'descript' => Input::get('message'),
                'selection' => Input::get('selection'),
            ),
            array(
                'title' => 'required|min:4|max:80',
                'descript' => 'required|max:3000',
                'selection' => 'required'
            )
        );

        if($validator->fails()){
            return Redirect::route('home')
                ->withErrors($validator);
        }else{
            $title = Input::get('name');
            $descript = Input::get('message');
            $selection   = Input::get('selection');
            $game_id = 1;
            
            $news   = News::create(array(
                'title' => $title,
                'descript' => $descript,
                'selection' => $selection,
                'game_id' => $game_id
            ));
            if($news){
                return Redirect::route('home')
                    ->with('global', 'Your news has been create');
                    }   
            }
        }
///////////////////////////////////////////////////////////////////////////////////////


}