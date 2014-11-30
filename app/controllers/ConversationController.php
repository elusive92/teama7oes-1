<?php

class ConversationController extends BaseController {
    public function getInbox(){
        return View::make('message.inbox');
    }
    public function getConversation(){
        $conversation_id = Input::get('conversation_id');
        $conversation = Conversation::where('id', '=', $conversation_id)->first();
        if(Auth::user()->id == $conversation->userA->id){
            $username = $conversation->userB->username;
        }else{
            $username = $conversation->userA->username;
        }
        return Response::json([
            'username' => $username
        ]);
    }

    public function addConvs(){
        $validator = Validator::make(
            array(
                'nickname' => Input::get('nick')
            ),
            array(
                'nickname' => 'required'
            )
        );
        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $user = User::where('username', '=', Input::get('nick'))
            ->first();

        if($user) {
            if (($user->id) == (Auth::user()->id)) {
                return Response::json([
                    'success' => false,
                    'error' => array('error' => 'You cant talk to yourself.'),
                    'redirect' => Redirect::intended('/')
                ]);
            }else{
                $conversation1 = Conversation::where('id_A', '=', Auth::user()->id)
                    ->where('id_B', '=', $user->id)
                    ->first();
                if($conversation1){
                    return Response::json([
                        'success' => true,
                        'id' => $conversation1->id
                    ]);
                }else{
                    $conversation2 = Conversation::where('id_A', '=', $user->id)
                        ->where('id_B', '=', Auth::user()->id)
                        ->first();
                    if($conversation2){
                        return Response::json([
                            'success' => true,
                            'id' => $conversation2->id
                        ]);
                    }else{
                        $conversation = Conversation::create(array(
                            'id_A' => Auth::user()->id,
                            'id_B' => $user->id,
                            'last_activity' => date("Y-m-d H:i:s")
                        ));
                        if($conversation) {
                            return Response::json([
                                'success' => true,
                                'id' => $conversation->id
                            ]);
                        }
                    }
                }
            }
        }else{
            return Response::json([
                'success' => false,
                'error' => array('error' => 'User with this username does not exists.'),
                'redirect' => Redirect::intended('/')
            ]);
        }
    }

    public function getMessages(){
        $conversation_id = Input::get('conversation_id');
        $conversation = Conversation::where('id', '=', $conversation_id)->first();
        if((Auth::user()->id == $conversation->id_A) && $conversation->unreaded == 1){
            $conversation->unreaded = 0;
            $conversation->save();
        }elseif((Auth::user()->id == $conversation->id_B) && $conversation->unreaded == 2){
            $conversation->unreaded = 0;
            $conversation->save();
        }
        $messages_all = Message::where('conversation_id', '=', $conversation_id)
            ->orderBy('senddate', 'asc')
            ->get();
        $messages = array();
        foreach($messages_all as $message){
            $messages[] = array('sender'=>$message->user->username,
                'message'=>$message->text,
                'date'=>$message->senddate);
        }

        foreach($messages as $message) {
            echo '<strong class="pull-left">'.$message['sender'].'</strong> <strong class="pull-right">'.$message['date'].'</strong>';
            echo '<div class="clearfix"></div>';
            echo '<p style="padding-top: 10px">'.$message['message'].'</p>';

        }
        //return Response::json(array('message' => $messages));
    }

    public function sendMessage(){
        $conversation_id = Input::get('cid');
        $message_text = htmlentities(strip_tags(Input::get('message')), ENT_QUOTES);
        $sender_id = Input::get('sender');
        if(strlen($message_text) > 0) {
            $message = Message::create(array(
                'conversation_id' => $conversation_id,
                'user_id' => $sender_id,
                'text' => $message_text,
                'senddate' => date("Y-m-d H:i:s")
            ));
            if ($message) {
                $conversation = Conversation::where('id', '=', $conversation_id)->first();
                $conversation->last_activity = date("Y-m-d H:i:s");
                if($sender_id == $conversation->id_A){
                    $conversation->unreaded = 2;
                    $conversation->save();
                }else{
                    $conversation->unreaded = 1;
                    $conversation->save();
                }
                return Response::json(['success' => true]);
            }
        }
    }

    public function friendList(){
        $friends = Conversation::where(function($query)
        {
            $query->where('id_A', '=', Auth::user()->id)
                ->orWhere('id_B', '=', Auth::user()->id);
        })
        ->whereExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('friendlist')
                ->whereRaw('friendlist.id_adding = '.Auth::user()->id.'')
                ->whereRaw('friendlist.id_friend = conversations.id_B')
                ->orWhereRaw('friendlist.id_friend = conversations.id_A');
        })
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('blacklists')
                ->whereRaw('blacklists.id_A = conversations.id_A')
                ->whereRaw('blacklists.id_B = conversations.id_B');
        })
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('blacklists')
                ->whereRaw('blacklists.id_A = conversations.id_B')
                ->whereRaw('blacklists.id_B = conversations.id_A');
        })
        ->orderBy('last_activity', 'desc')
        ->get();

        foreach($friends as $friend){
            if($friend->userA->id == Auth::user()->id){
                echo '<li class="list-group-item">';
                    if($friend->userB->photo){
                        echo '<img src="'.URL::asset('/').''.$friend->userB->photo.'" width="30" height="30" />';
                    }else{
                        echo '<img src="'.URL::asset('/').'img/default1.jpg" width="30" height="30" />';
                    }
                    echo '<button type="button" value="'.$friend->id.'" class="btn btn-link getconv">';
                        if($friend->unreaded == 1){
                            echo '<strong style="color: #d40d12">'.$friend->userB->username.'</strong>';
                        }else{
                            echo $friend->userB->username;
                        }
                    echo '</button>';
                echo '</li>';
            }else{
                echo '<li class="list-group-item">';
                    if($friend->userA->photo){
                        echo '<img src="'.URL::asset('/').''.$friend->userA->photo.'" width="30" height="30" />';
                    }else{
                        echo '<img src="'.URL::asset('/').'img/default1.jpg" width="30" height="30" />';
                    }
                    echo '<button type="button" value="'.$friend->id.'" class="btn btn-link getconv">';
                        if($friend->unreaded == 2){
                            echo '<strong style="color: #d40d12">'.$friend->userA->username.'</strong>';
                        }else{
                            echo $friend->userA->username;
                        }
                    echo '</button>';
                echo '</li>';
            }
        }
    }

    public function otherList(){
        $others = Conversation::where(function($query)
        {
            $query->where('id_A', '=', Auth::user()->id)
                ->orWhere('id_B', '=', Auth::user()->id);
        })
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('friendlist')
                ->whereRaw('friendlist.id_adding = '.Auth::user()->id.'')
                ->whereRaw('friendlist.id_friend = conversations.id_B');
        })
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('friendlist')
                ->whereRaw('friendlist.id_adding = '.Auth::user()->id.'')
                ->whereRaw('friendlist.id_friend = conversations.id_A');
        })
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('blacklists')
                ->whereRaw('blacklists.id_A = conversations.id_A')
                ->whereRaw('blacklists.id_B = conversations.id_B');
        })
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('blacklists')
                ->whereRaw('blacklists.id_A = conversations.id_B')
                ->whereRaw('blacklists.id_B = conversations.id_A');
        })
        ->orderBy('last_activity', 'desc')
        ->get();

        foreach($others as $other){
            if($other->userA->id == Auth::user()->id){
                echo '<li class="list-group-item">';
                if($other->userB->photo){
                    echo '<img src="'.URL::asset('/').''.$other->userB->photo.'" width="30" height="30" />';
                }else{
                    echo '<img src="'.URL::asset('/').'img/default1.jpg" width="30" height="30" />';
                }
                echo '<button type="button" value="'.$other->id.'" class="btn btn-link getconv">';
                if($other->unreaded == 1){
                    echo '<strong style="color: #d40d12">'.$other->userB->username.'</strong>';
                }else{
                    echo $other->userB->username;
                }
                echo '</button>';
                echo '</li>';
            }else{
                echo '<li class="list-group-item">';
                if($other->userA->photo){
                    echo '<img src="'.URL::asset('/').''.$other->userA->photo.'" width="30" height="30" />';
                }else{
                    echo '<img src="'.URL::asset('/').'img/default1.jpg" width="30" height="30" />';
                }
                echo '<button type="button" value="'.$other->id.'" class="btn btn-link getconv">';
                if($other->unreaded == 2){
                    echo '<strong style="color: #d40d12">'.$other->userA->username.'</strong>';
                }else{
                    echo $other->userA->username;
                }
                echo '</button>';
                echo '</li>';
            }
        }
    }

}