<div class="bg-grey-lighter px-4 py-4 flex items-center">
    <form method="POST" autocapitalize="off" class="flex-1 flex justify-center items-center">
        <div class="flex-1 mx-4">
            @csrf
            <input class="w-full border rounded px-2 py-2" type="text" />
        </div>
        <button class="col-span-2" type='submit'>Send</button>
    </form>
</div>
