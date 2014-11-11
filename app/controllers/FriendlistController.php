<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return  Redirect::route('friendlist');
    ;
});


class FriendlistController extends BaseController {


}
