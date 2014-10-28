<?php
class GalleryController extends BaseController {

    public function getGallery(){
        //-----------------------------------------
        //$name = User::where('username', )
        // tu sie to zautomatyzuje ale jeszce brak mi weny :D

        //--------------------------------
        $photos = Gallery::where('id', 1)->get();
        return View::make('gallery.gallery')->with('photos', $photos);
    }
}