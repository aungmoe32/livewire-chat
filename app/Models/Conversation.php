<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'sender_id'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function firstMessageDate()
    {
        return $this->messages()->first()?->created_at?->format('Y-M-d');
    }

    public function lastMessage()
    {
        return $this->messages()->latest()->first();
    }

    public function unreadMessagesCount(): int
    {
        return Message::where('conversation_id', '=', $this->id)
            ->where('receiver_id', auth()->user()->id)
            ->whereNull('read_at')->count();
    }

    public  function isLastMessageReadByUser(): bool
    {
        $lastMessage = $this->lastMessage();

        if ($lastMessage) {
            return  $lastMessage->read_at !== null && $lastMessage->sender_id == auth()->id();
        }
        return false;
    }

    public function getReceiver()
    {
        if ($this->sender_id === auth()->id()) {
            return User::firstWhere('id', $this->receiver_id);
        } else {
            return User::firstWhere('id', $this->sender_id);
        }
    }


    public function scopeWhereNotDeleted($query)
    {
        $userId = auth()->id();

        return $query->where(function ($query) use ($userId) {
            # Conversations that have messages which are not deleted by me
            $query->whereHas('messages', function ($query) use ($userId) {

                $query->where(function ($query) use ($userId) {
                    $query->where('sender_id', $userId)
                        ->whereNull('sender_deleted_at');
                })->orWhere(function ($query) use ($userId) {
                    $query->where('receiver_id', $userId)
                        ->whereNull('receiver_deleted_at');
                });
            })
                # include conversations without messages
                ->orWhereDoesntHave('messages');
        });
    }
}
