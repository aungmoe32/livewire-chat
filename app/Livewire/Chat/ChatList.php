<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatList extends Component
{
    public $selectedConversation;
    public $selectedConversationId;

    public function mount()
    {
        $this->selectedConversationId = $this->selectedConversation?->id;
    }

    public function render()
    {
        $user = auth()->user();

        return view('livewire.chat.chat-list', [
            'conversations' => $user->conversations()->latest('updated_at')->get()
        ]);
    }
}
