<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ChatBox extends Component
{
    public $selectedUser;

    public function mount()
    {
        $userId = Session::get('selectedUser'); // সেশন থেকে User ID পড়া
        if ($userId) {
            $this->selectedUser = User::find($userId);
        }
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
}

