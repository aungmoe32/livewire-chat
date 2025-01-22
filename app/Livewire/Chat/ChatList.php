<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;

#[On('refresh')]
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
