<?php

class ConversationController extends BaseController {
    public function getInbox(){
        if(Auth::check()){
            $friends = Conversation::where(function($query)
            {
                $query->where('id_A', '=', Auth::user()->id)
                    ->orWhere('id_B', '=', Auth::user()->id);
            })
            ->whereExists(function($query)
            {
                $query->select(DB::raw(1))
                    ->from('friendlist')
                    ->whereRaw('friendlist.id_adding = conversations.id_A')
                    ->whereRaw('friendlist.id_friend = conversations.id_B');
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
            $others = Conversation::where(function($query)
            {
                $query->where('id_A', '=', Auth::user()->id)
                    ->orWhere('id_B', '=', Auth::user()->id);
            })
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                    ->from('friendlist')
                    ->whereRaw('friendlist.id_adding = conversations.id_A')
                    ->whereRaw('friendlist.id_friend = conversations.id_B');
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
        }
        return View::make('message.inbox')
            ->with('friends', $friends)
            ->with('others', $others);
    }
    public function getConversation(){
        $conversation_id = Input::get('conversation_id');
        $conversation = Conversation::where('id', '=', $conversation_id)->first();
        if(Auth::user()->id == $conversation->userA->id){
            $username = $conversation->userB->username;
        }else{
            $username = $conversation->userA->username;
        }
        $messages = Message::where('conversation_id', '=', $conversation_id)
            ->orderBy('senddate', 'desc')
            ->get();
        return Response::json([
            'messages' => $messages,
            'username' => $username
        ]);
    }

}