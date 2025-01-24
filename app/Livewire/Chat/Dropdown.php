<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;

class Dropdown extends Component
{
    public $conversation;

    public function deleteByUser($conversation_id)
    {
        $userId = auth()->id();
        $conversation = Conversation::find(decrypt($conversation_id));

        // Mark all my messages of selected conversation as deleted
        $conversation->messages()->each(function ($message) use ($userId) {
            if ($message->sender_id === $userId) {
                $message->update(['sender_deleted_at' => now()]);
            } elseif ($message->receiver_id === $userId) {
                $message->update(['receiver_deleted_at' => now()]);
            }
        });

        // Get do receiver already deleted conversation
        $receiverAlsoDeleted = $conversation->messages()
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })->where(function ($query) use ($userId) {
                $query->whereNull('sender_deleted_at')
                    ->orWhereNull('receiver_deleted_at');
            })->doesntExist();

        // If receiver already deleted conversation, force delete conversation
        if ($receiverAlsoDeleted) {
            $conversation->forceDelete();
        }

        return redirect(route('chat.index'));
    }

    public function render()
    {
        return view('livewire.chat.dropdown');
    }
}
