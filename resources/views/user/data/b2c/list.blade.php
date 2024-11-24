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