<?php

class ConversationController extends BaseController {
    public function getInbox(){
        if(Auth::check()){
            $conversations = Conversation::where(function ($query) {
                $query->where('id_A', '=', Auth::user()->id)
                    ->orWhere('id_B', '=', Auth::user()->id);
            })->get();
        }
        return View::make('message.inbox')->with('conversations', $conversations);
    }

}