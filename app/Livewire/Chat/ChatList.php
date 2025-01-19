<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatList extends Component
{
    public $conversation;

    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}
