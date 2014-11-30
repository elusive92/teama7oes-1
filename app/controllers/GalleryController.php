<?php
class GalleryController extends BaseController {

    public function getGallery($username){
        $user = User::where('username', '=', $username);
        if($user->count()){
            $user = $user->first();

        $photos = Gallery::where('user_id','=',$user->id)->paginate(12);
        return View::make('gallery.gallery')->with('photos', $photos);
    }}

    public function postAddPicture()
    {
        if(Input::file('image')){
        $user = User::where('id', '=', Input::get('id'))->first();
        $extension = Input::file('image')->getClientOriginalExtension();
        $filename = str_random(10) . '.' . $extension;
        $destinationPath = 'img/gallery/' . $user->id;
        $destinationPathmini = $destinationPath . '/mini';

            $validator = Validator::make(
                array(
                    'title' => Input::get('title'),
                    'descript' => Input::get('descript'),
                    'filename' => $filename),
                array(
                    'title' => 'required|min:1|max:30',
                    'descript' => 'required|min:1|max:255',
                    'filename' => 'required|min:1|max:20'
                ));

            if ($validator->fails()) {
                return Response::json([
                    'success' => false,
                    'error' => $validator->errors()->toArray()
                ]);}


        if (($extension == 'jpg') || ($extension == 'jpeg') || ($extension == 'png')) {
            $gallery = new Gallery;
                $gallery->user_id = Auth::user()->id;
                $gallery->title = Input::get('title');
                $gallery->descript = Input::get('descript');
                $gallery->date = date("Y-m-d H:i:s");
                $gallery->filename = $filename;
                $gallery->save();

                $uploadSuccess = Input::file('image')->move($destinationPath, $filename);

                if ($gallery->save() and $uploadSuccess) {
                    $uploadSuccess_mini = Image::make($destinationPath . '/' . $filename)->resize('200', '100')->save($destinationPathmini . $filename);
                    if ($uploadSuccess_mini){
                         return Response::json([
                            'success' => true,
                            'redirect' => Redirect::intended('/')]);}
                    else{
                        return Response::json([
                            'success' => false,
                            'error' => array('error' => 'Something went wrong.'),
                            'redirect' => Redirect::intended('/')
                        ]);
                    }
                } return Response::json([
                'success' => false,
                'error' => array('error' => 'Something went wrong.'),
                'redirect' => Redirect::intended('/')
            ]);


            } else{
            return Response::json([
                'success' => false,
                'error' => array('error' => 'File is not an image or has wrong extension.'),
                'redirect' => Redirect::intended('/')
            ]);
            }

        }else{
            return Response::json([
                'success' => false,
                'error' => array('error' => 'Please choose Image.'),
                'redirect' => Redirect::intended('/')]);
        }
    }}