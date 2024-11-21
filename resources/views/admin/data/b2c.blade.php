<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                @include('admin.layouts.sidebar')
                <main class="p-6 w-full overflow-hidden">
                    <div class="container mx-auto">
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold">Données {{ strtoupper($type) }} - {{ $pays->name }}</h2>
                            
                            <form action="{{ route('admin.import.readHeaders', ['pays' => $pays->name, 'type' => $type]) }}" 
                                method="POST" 
                                enctype="multipart/form-data" 
                                class="bg-gray-50 p-4 rounded-lg border mt-4">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <div class="flex-grow">
                                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">
                                            Importer un fichier Excel
                                        </label>
                                        <input type="file" 
                                               id="file"
                                               name="file" 
                                               accept=".xlsx,.xls,.csv"
                                               class="block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-md file:border-0
                                                      file:text-sm file:font-semibold
                                                      file:bg-blue-50 file:text-blue-700
                                                      hover:file:bg-blue-100" 
                                               required>
                                    </div>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Charger
                                    </button>
                                </div>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </form>

                            <!-- Formulaire de recherche -->
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
                        </div>

                        <!-- Table Container avec scroll horizontal -->
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

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $data->appends(request()->query())->links() }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <style>
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }
        
        @media (max-width: 640px) {
            .container {
                padding-left: 0;
                padding-right: 0;
            }
            
            .overflow-x-auto {
                margin-left: -1rem;
                margin-right: -1rem;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</x-app-layout>