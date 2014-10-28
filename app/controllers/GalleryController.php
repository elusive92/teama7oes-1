<?php
class GalleryController extends BaseController {

    public function getGallery(){
        $photos = Gallery::where('id', 1)->get();
        return View::make('gallery.gallery')->with('photos', $photos);
    }
}