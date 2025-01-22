@props([
    'active' => false,
    'key' => '',
    'conversation' => null,
])


<div class="px-3 flex items-center cursor-pointer hover:bg-gray-100 {{ $active ? 'bg-gray-100' : 'bg-white' }}">
    <a href="{{ route('chat', $conversation->id) }}" id="conversation-{{ $conversation->id }}"
        class="flex-1 flex justify-center items-center space-x-2">
        {{-- Profile Image --}}
        <img src="https://randomuser.me/api/portraits/men/{{ $key }}.jpg" alt="image"
            class="w-12  rounded-full shadow-lg">

        <div class="flex-1 border-b border-grey-lighter py-4">
            <div class="flex flex-1 items-center space-x-4 justify-center ">
                {{-- Name --}}
                <p class="text-grey-darkest">
                    {{ $conversation->getReceiver()->name }}
                </p>

                {{-- Date --}}
                <p class="text-[13px] text-gray-500">
                    {{ $conversation->messages?->last()?->created_at?->shortAbsoluteDiffForHumans() }}
                </p>
            </div>

            @php
                $lastMsg = $conversation->lastMessage();
            @endphp
            <p class="flex items-start space-x-2  text-grey-dark mt-1 text-sm text-gray-500">
                @if ($lastMsg)
                    {{-- single ticks --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-check2-all w-4 text-blue-500" viewBox="0 0 16 16">
                        <path
                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                    </svg>

                    {{-- Double ticks --}}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                       class="bi bi-check2-all w-4 text-blue-500" viewBox="0 0 16 16">
                       <path
                           d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                       <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                   </svg> --}}

                    <span>
                        {{ $lastMsg->body }}
                    </span>
                @endif
            </p>
        </div>
    </a>
    <x-chat.dropdown></x-chat-dropdown>
</div>
