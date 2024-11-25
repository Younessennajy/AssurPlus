<form action="{{ route('admin.pays.' . $type, ['pays' => $pays->name]) }}" method="GET" class="mt-4">
    <div class="flex gap-2">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}"
               class="w-80 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="Rechercher...">
        <button type="submit" 
                class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            Rechercher
        </button>
    </div>
</form>