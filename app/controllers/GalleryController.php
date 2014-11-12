<?php
class GalleryController extends BaseController {

    public function getGallery(){

        $photos = Gallery::where('user_id','=',Auth::user()->id)->paginate(10);
        return View::make('gallery.gallery')->with('photos', $photos);
    }

    public function postAddPicture(){
        $user = Auth::user()->id;
        $extension = strtolower(Input::file('logo')->getClientOriginalExtension());
        $filename = str_random(10) . '.' . $extension;
        $destinationPath = 'img/teams/logos/'.$user;

        if(($extension == 'jpg') || ($extension == 'jpeg') || ($extension == 'png')){

            $validator = Validator::make(Input::all(),
                array(
                    'title' 		=> 'required|max:30|min:3',
                    'descript' 		=> 'max:255',
                    'filename' 		=> 'required|max:20',

                )
            );

            if($validator->fails()){
                return Redirect::route('ugallery')
                    ->withErrors($validator)
                    ->withInput();
            }else{

                $image = new Gallery;
                $image->user_id = Auth::user()->id;
                $image->title = Input::get('title');
                $image->descript = Input::get('descript');
                $image->date = date("Y-m-d H:i:s");
                $image->save();

                if($image){
                    return Redirect::route('ugallery');
                }


            }
        }

    }
}