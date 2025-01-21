<div class="bg-grey-lighter px-4 py-4 flex items-center">
    <form wire:submit="save" autocapitalize="off" class="flex-1 flex justify-center items-center">
        <div class="flex-1 mx-4">
            <input wire:model="body" class="w-full border rounded px-2 py-2" type="text" />
        </div>
        {{-- <button class=" bg-blue-300 text-white hover:bg-blue-400 rounded-sm px-3 py-1 col-span-2" type='submit'>Send
        </button> --}}
        <x-primary-button type="submit">Send</x-primary-button>
    </form>
</div>
