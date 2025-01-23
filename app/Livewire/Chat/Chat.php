<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Conversation;
use App\Notifications\MessageRead;
use App\Notifications\MessageSent;

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

    // Load latest messages based on paginate_var
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

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
        return [
            "echo-private:users.{$auth_id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'onBroadcastedNotifications'
        ];
    }

    public function onBroadcastedNotifications($event)
    {
        if ($event['type'] == MessageSent::class) {
            if ($event['conversation_id'] == $this->conversation->id) {
                $newMessage = Message::find($event['message_id']);

                // Mark Read
                $newMessage->read_at = now();
                $newMessage->save();

                // Broadcast message read
                $this->conversation->getReceiver()
                    ->notify(new MessageRead($this->conversation->id));

                $this->refreshMsgs();
            }
        }

        // if ($event['type'] == MessageRead::class) {
        // $this->refreshMsgs();
        // }
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
