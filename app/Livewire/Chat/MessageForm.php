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
        $this->dispatch('refresh-messages');
    }


    public function render()
    {
        return view('livewire.chat.message-form');
    }
}
