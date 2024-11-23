<div class="mt-6 bg-gray-50 p-6 rounded-lg border shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Configuration des colonnes</h3>
        <button type="button" 
                id="toggleAll" 
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-sm">
            Tout afficher/masquer
        </button>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" id="columnToggles">
        @if($data->count() > 0)
            @foreach($data->first()->getAttributes() as $column => $value)
                @unless(in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))
                    <label class="inline-flex items-center">
                        <input type="checkbox" 
                               class="column-toggle form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                               data-column="{{ $column }}"
                               checked>
                        <span class="ml-2 text-sm text-gray-700">{{ $column }}</span>
                    </label>
                @endunless
            @endforeach
        @endif
    </div>
</div>