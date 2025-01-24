<div class="border flex flex-col bg-white" x-data="{ selectedConversationId: @entangle('selectedConversationId') }" x-init="setTimeout(() => {
    conversationElement = document.getElementById('conversation-' + selectedConversationId);
    if (conversationElement) {
        conversationElement.scrollIntoView({ 'behavior': 'smooth' });
    }
}, 200);

Echo.private('users.{{ Auth()->User()->id }}')
    .notification((notification) => {
        if (notification['type'] == 'App\\Notifications\\MessageRead' || notification['type'] == 'App\\Notifications\\MessageSent') {
            $wire.$refresh();
        }
    });">

    <div class="p-2">
        <span class="font-bold text-2xl">Chats</span>
    </div>

    {{-- Filter Chats --}}
    <div class="flex justify-start items-center p-2 space-x-2 mb-2" x-data="{ type: 'all' }">
        <button wire:click="filterChats('all')" @click="type='all'"
            :class="{ 'bg-blue-100 border-0 text-black': type == 'all' }"
            class="inline-flex justify-center items-center rounded-full gap-x-1 text-xs font-medium px-3 lg:px-5 py-1  lg:py-2.5 border ">
            All
        </button>

        <button wire:click="filterChats('deleted')" @click="type='deleted'"
            :class="{ 'bg-blue-100 border-0 text-black': type == 'deleted' }"
            class="inline-flex justify-center items-center rounded-full gap-x-1 text-xs font-medium px-3 lg:px-5 py-1  lg:py-2.5 border ">
            Deleted
        </button>
    </div>

    <!-- Conversations -->
    <div class=" flex-1 overflow-auto">
        @if ($conversations)
            @foreach ($conversations as $key => $conversation)
                <x-chat.chat-item :active="$conversation->id == $selectedConversation?->id" :conversation="$conversation" :key="$key" />
            @endforeach
        @else
            <div>Empty List</div>
        @endif
    </div>
</div>
