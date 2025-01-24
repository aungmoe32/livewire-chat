<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;

#[On('refresh')]
class ChatList extends Component
{
    public $selectedConversation;
    public $selectedConversationId;
    public $filterType = 'all';

    public function mount()
    {
        $this->selectedConversationId = $this->selectedConversation?->id;
    }

    public function filterChats($type)
    {
        // logger($type);
        $this->filterType = $type;
    }

    public function render()
    {
        $user = auth()->user();
        $conversations = null;

        if ($this->filterType == 'deleted') {
            // dd($conversations);
            $conversations = $user->conversations()->whereDeleted()->latest('updated_at')->get();
        } else {
            $conversations = $user->conversations()->whereNotDeleted()->latest('updated_at')->get();
        }

        return view('livewire.chat.chat-list', [
            'conversations' => $conversations
        ]);
    }
}
