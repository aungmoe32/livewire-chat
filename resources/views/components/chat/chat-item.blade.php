@props([
    'active' => false,
    'name' => 'User',
])
<div class="px-3 flex items-center  cursor-pointer hover:bg-gray-100 {{ $active ? 'bg-gray-200' : 'bg-white' }}">
    <div>
        <img class="h-12 w-12 rounded-full"
            src="https://darrenjameseeley.files.wordpress.com/2014/09/expendables3.jpeg" />
    </div>
    <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
        <div class="flex items-bottom justify-between">
            <p class="text-grey-darkest">
                {{ $name }}
            </p>
            <p class="text-[13px] text-gray-500">
                12:45 pm
            </p>
        </div>
        <p class="flex items-start space-x-2  text-grey-dark mt-1 text-sm text-gray-500">
            {{-- Double ticks --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-all w-4 text-blue-500"
                viewBox="0 0 16 16">
                <path
                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
            </svg>
            <span>
                how are you
            </span>
        </p>
    </div>
    <x-chat.dropdown></x-chat-dropdown>
</div>
