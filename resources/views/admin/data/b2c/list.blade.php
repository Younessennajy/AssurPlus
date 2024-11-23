<div class="w-full overflow-x-auto relative">
    <div class="rounded-lg shadow">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-gray-50">
                <tr>
                    @if($data->count() > 0)
                        @foreach($data->first()->getAttributes() as $column => $value)
                            @unless(in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $column }}
                                </th>
                            @endunless
                        @endforeach
                    @else
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                            Aucune donnée disponible
                        </th>
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
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $value }}
                                </td>
                            @endunless
                        @endforeach
                        <!-- Colonne Actions -->
                        <td class="px-6 py-4 text-sm text-gray-900 text-right">
                            <!-- Bouton Modifier -->
                            <a href="{{ route('admin.data.edit', ['pays' => $pays->name, 'type' => $type, 'id' => $row->id]) }}" 
                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Modifier
                            </a>
                            
                            <!-- Bouton Supprimer -->
                            <form action="{{ route('admin.data.delete', ['pays' => $pays->name, 'type' => $type, 'id' => $row->id]) }}" 
                                method="POST">
                              @csrf
                              @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')" 
                                        class="px-4 py-2 bg-red-500 text-white text-xs rounded-md hover:bg-red-600">
                                    Supprimer
                                </button>
                            </form>
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