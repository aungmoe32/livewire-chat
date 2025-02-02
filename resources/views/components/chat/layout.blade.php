@props(['selectedConversation' => null])

<div class="flex border border-grey rounded shadow-lg h-screen w-full absolute top-0 left-0 pt-16 ">
    <!-- Left -->
    <livewire:chat.chat-list :selected-conversation="$selectedConversation"></livewire:chat.chat-list>

    <!-- Right -->
    {{ $slot }}
</div>
