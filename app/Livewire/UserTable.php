<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserTable extends Component
{
    public function openChat($userId)
    {
        Session::put('selectedUser', $userId); // সেশনে User ID সংরক্ষণ করা
        return redirect()->route('chat'); // চ্যাট পেজে পাঠানো
    }

    public function render()
{
    $users = User::where('id', '!=', Auth::user()->id)->withCount(['unreadMessages'])->get(); // personal id hides
    return view('livewire.user-table', compact('users'));
}

}
