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
    public $paginate_var = 10;

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
        $count = Message::where('conversation_id', $this->conversation->id)
            ->count();

        $this->loadedMessages = Message::where('conversation_id', $this->conversation->id)
            ->skip($count - $this->paginate_var)
            ->take($this->paginate_var)
            ->get();

        return $this->loadedMessages;
    }

    #[On('load-more')]
    public function loadMore(): void
    {
        // Add 10 more messages to load
        $this->paginate_var += 10;

        $this->loadMessages();

        // Dispatch to browser on Chat Component to restore scroll position when new messages loaded
        $this->dispatch('update-chat-height');
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
