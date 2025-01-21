<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Conversation;

class Chat extends Component
{
    public Conversation $conversation; // Selected Conversation
    public $loadedMessages;

    public function mount()
    {
        $this->loadMessages();
    }

    #[On('refresh-messages')]
    public function refreshMsgs()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->loadedMessages = $this->conversation->messages;
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
