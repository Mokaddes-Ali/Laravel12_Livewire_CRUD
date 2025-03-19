<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatBox extends Component
{
    public $selectedUser;
    public $message;
    public $senderId;
    public $receiverId;
    public $messages;


    public function mount()
    {
        $userId = Session::get('selectedUser'); // সেশন থেকে User ID পড়া
        if ($userId) {
            $this->selectedUser = User::find($userId);
        }
        $this->senderId = auth()->id();
        $this->receiverId = $this->selectedUser->id;

        $this->messages = $this->getMessage();
        // dd($message);

    }

    public function closeChat()
    {
        Session::forget('selectedUser'); // সেশন থেকে User ID মুছে ফেলা
        return redirect()->route('userschat.index'); // ইউজার লিস্ট পেজে পাঠানো
    }

    public function render()
    {
        return view('livewire.chat-box', ['selectedUser' => $this->selectedUser]);
    }

    public function getMessage()
{

//    dd
     return Message::with('sender:id,name', 'receiver:id,name')
         ->where( function ($query){
            return $query->where('sender_id', $this->senderId)
            ->where('receiver_id', $this->receiverId);
         })
        ->orWhere( function($query){
            return $query->where('sender_id', $this->receiverId)
            ->where('receiver_id', $this->senderId);
        })->get();


}


    public function sendMessage()
    {
       $this->saveMessage();

       $this->message = null;
    }

    public function saveMessage()
    {
        // dd([
        //     'sender_id' => $this->senderId,
        //     'receiver_id'=> $this->receiverId,
        //     'message' => $this->message,
        //     // 'file_name',
        //     // 'file_original_name',
        //     // 'folder_path',
        //     'is_read' => false,

        // ]);


        return Message::create([
            'sender_id' => $this->senderId,
            'receiver_id'=> $this->receiverId,
            'message' => $this->message,
            // 'file_name',
            // 'file_original_name',
            // 'folder_path',
            'is_read' => false,

        ]);
    }
}

