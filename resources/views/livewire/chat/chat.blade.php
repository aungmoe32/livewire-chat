<x-chat.layout :selected-conversation="$conversation">
    <div class="flex-1 border flex flex-col" x-data="{
        height: 0,
        markAsRead: null,
        msgContainerElement: document.getElementById('messages-container'),
    }" x-init="height = msgContainerElement.scrollHeight;
    msgContainerElement.scrollTop = height

    Echo.private('users.{{ Auth()->User()->id }}')
        .notification((notification) => {
            if (notification['type'] == 'App\\Notifications\\MessageRead' && notification['conversation_id'] == {{ $conversation->id }}) {
                markAsRead = true;
            }
        });"
        x-on:scroll-bottom.window="$nextTick(()=>msgContainerElement.scrollTop = msgContainerElement.scrollHeight)">

        <!-- Header -->
        <div class="py-2 px-3 bg-white flex flex-row justify-between items-center">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-full"
                    src="https://i.pravatar.cc/150?img={{ $conversation->getReceiver()->id }}" />
                <div class="ml-4">
                    <p class="text-grey-darkest">
                        {{ $conversation->getReceiver()->name }}
                    </p>
                </div>
            </div>

            <div class="flex">
                <div class="ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#263238" fill-opacity=".6"
                            d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div @scroll="
        scropTop = $el.scrollTop;
        if(scropTop <= 0){
          $dispatch('load-more');
        }"
            @update-chat-height.window="
            $nextTick(() => {
                newHeight= $el.scrollHeight;
                oldHeight= height;
                $el.scrollTop= newHeight- oldHeight;
                height=newHeight;
            })
     "
            class="flex-1 overflow-auto px-3 py-4 bg-gray-200" id="messages-container">

            {{-- Messages List --}}
            @if ($loadedMessages)
                @foreach ($loadedMessages as $message)
                    <x-chat.message :message="$message" :is-mine="$message->sender_id == auth()->id()" />
                @endforeach
            @endif
        </div>

        <!-- Chat Input -->
        <livewire:chat.message-form :selected-conversation="$conversation" />
    </div>

</x-chat.layout>
