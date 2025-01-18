<div class="flex border border-grey rounded shadow-lg h-screen w-full absolute top-0 left-0 pt-16 ">
    <!-- Left -->
    <livewire:chat.chat-list />

    <!-- Right -->
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
