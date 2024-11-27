<div class="w-full overflow-x-auto relative">
    <div class="rounded-lg shadow">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    @if($data->count() > 0)
                        @foreach($data->first()->getAttributes() as $column => $value)
                            @unless(in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors duration-200"
                                    onclick="sortTable('{{ $column }}')"
                                    data-column="{{ $column }}">
                                    <div class="flex items-center space-x-2">
                                        <span>{{ $column }}</span>
                                        <span class="text-gray-400">
                                            @if(request('sort') === $column)
                                                @if(request('direction') === 'asc')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                @endif
                                            @else
                                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                </th>
                            @endunless
                        @endforeach
                    @else
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500">
                            Aucune donnée disponible
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        @foreach($row->getAttributes() as $column => $value)
                            @unless(in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $value }}
                                </td>
                            @endunless
                        @endforeach
                        
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-8 text-sm text-gray-500 text-center" colspan="100%">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <span>Aucun enregistrement trouvé</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-3px);
    }
}
</style>

<script>
function sortTable(column) {
    const currentUrl = new URL(window.location.href);
    const currentSort = currentUrl.searchParams.get('sort');
    const currentDirection = currentUrl.searchParams.get('direction');
    
    let newDirection = 'asc';
    
    if (currentSort === column && currentDirection === 'asc') {
        newDirection = 'desc';
    }
    
    currentUrl.searchParams.set('sort', column);
    currentUrl.searchParams.set('direction', newDirection);
    
    window.location.href = currentUrl.toString();
}
</script>