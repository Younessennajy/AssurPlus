<div>
    <form wire:submit.prevent="upload">
        <input type="file" wire:model="file" class="mb-4">
        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Upload File
        </button>
    </form>
</div>
