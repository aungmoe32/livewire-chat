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

        // Mark message belogning to receiver as read
        Message::where('conversation_id', $this->conversation->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    #[On('refresh-messages')]
    public function refreshMsgs()
    {
        $this->loadMessages();

        // Event on browser to scroll bottom of chats
        $this->dispatch('scroll-bottom');
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
