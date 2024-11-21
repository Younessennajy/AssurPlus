<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                @include('admin.layouts.sidebar')
                <main class="p-6 w-full overflow-hidden">
                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="container mx-auto">
                        <div class="mb-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white">
                                <div>
                                    <h1 class="text-3xl font-bold mb-2">{{ $pays->name }}</h1>
                                    <h2 class="text-xl opacity-90">Données {{ strtoupper($type) }}</h2>
                                </div>
                                
                                <!-- Formulaire d'exportation -->
                                <form action="{{ route('admin.export', ['pays' => $pays->name, 'type' => $type]) }}" 
                                      method="POST" 
                                      class="mt-4 md:mt-0">
                                    @csrf
                                    <div class="flex flex-col md:flex-row gap-4">
                                        <div class="relative">
                                            <select name="format" 
                                                    id="export_format" 
                                                    class="bg-white/10 border border-white/20 text-white rounded-lg px-4 py-2 appearance-none w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-white/50">
                                                <option value="xlsx" class="text-gray-900">Excel (XLSX)</option>
                                                <option value="csv" class="text-gray-900">CSV</option>
                                            </select>
                                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <button type="submit" 
                                                class="inline-flex items-center px-6 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 font-semibold">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Exporter
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Formulaire d'import -->
                            <form action="{{ route('admin.import.readHeaders', ['pays' => $pays->name, 'type' => 'b2b']) }}" 
                                  method="POST" 
                                  enctype="multipart/form-data" 
                                  class="bg-gray-50 p-6 rounded-lg border mt-6 shadow-sm">
                                @csrf
                                <div class="flex flex-col md:flex-row items-center gap-4">
                                    <div class="flex-grow w-full">
                                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
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
                                                      hover:file:bg-blue-100
                                                      cursor-pointer" 
                                               required>
                                    </div>
                                    <button type="submit" 
                                            class="w-full md:w-auto px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        Charger
                                    </button>
                                </div>
                                @error('file')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </form>

                            <!-- Reste du code... -->
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