<div class="w-full overflow-x-auto relative">
    <div class="rounded-lg shadow">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-gray-50">
                <tr>
                    @if($data->count() > 0)
                        @foreach($data->first()->getAttributes() as $column => $value)
                            @unless(in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider column-header cursor-pointer"
                                    onclick="sortTable('{{ $column }}')"
                                    data-column="{{ $column }}">
                                    <div class="flex items-center">
                                        {{ $column }}
                                        @if(isset($sortColumn) && $sortColumn === $column)
                                            <span class="ml-1">
                                                @if($sortDirection === 'asc')
                                                    ↑
                                                @else
                                                    ↓
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </th>
                            @endunless
                        @endforeach
                    @endif
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50">
                        @foreach($row->getAttributes() as $column => $value)
                            @unless(in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))
                                <td class="px-6 py-4 text-sm text-gray-900 column-data"
                                    data-column="{{ $column }}">
                                    {{ $value }}
                                </td>
                            @endunless
                        @endforeach
                        <td class="px-6 py-4 text-sm text-gray-900 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.data.edit', ['pays' => $pays->name, 'type' => $type, 'id' => $row->id]) }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                   <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                </a>
                                <form action="{{ route('admin.data.delete', ['pays' => $pays->name, 'type' => $type, 'id' => $row->id]) }}" 
                                      method="POST" 
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')"
                                            class="px-4 py-2 bg-red-500 text-white text-sm rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500 text-center" colspan="100%">
                            Aucun enregistrement trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

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