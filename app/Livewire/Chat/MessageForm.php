<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Validate;

class MessageForm extends Component
{
    #[Validate('required')]
    public $body = '';
    public $selectedConversation;

    public function save()
    {
        $this->validate();

        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->selectedConversation->getReceiver()->id,
            'body' => $this->body
        ]);

        $this->pull('body');

        // Refresh messages for Chat Component
        $this->dispatch('refresh-messages')->to(Chat::class);

        // Update Conversation Date
        $this->selectedConversation->updated_at = now();
        $this->selectedConversation->save();

        // Refresh ChatList latest conversations
        $this->dispatch('refresh')->to(ChatList::class);
    }


    public function render()
    {
        return view('livewire.chat.message-form');
    }
}
