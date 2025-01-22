@props([
    'isMine' => false,
    'message' => null,
])
<div class="flex mb-2 {{ $isMine ? 'justify-end' : '' }}">
    <div @class([
        'rounded py-2 px-3',
        'bg-blue-400' => $isMine,
        'bg-white' => !$isMine,
    ])>
        <p @class([
            'text-sm my-1',
            'text-white' => $isMine,
            'text-black' => !$isMine,
        ])>
            {{ $message?->body }}
        </p>
        <div class="flex justify-center items-center space-x-1">
            <div class="flex-1"></div>
            <p class="text-right text-xs {{ $isMine ? 'text-white/80' : 'text-gray-400' }}">
                {{ $message->created_at->format('g:i a') }}
            </p>

            @if ($isMine)
                @if ($message->isRead())
                    {{-- Double ticks --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-all w-4 text-white"
                        viewBox="0 0 16 16">
                        <path
                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                    </svg>
                @else
                    {{-- single ticks --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-all w-4 text-white"
                        viewBox="0 0 16 16">
                        <path
                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                    </svg>
                @endif
            @endif
        </div>
    </div>
</div>
