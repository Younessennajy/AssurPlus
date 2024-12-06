<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6">
            <div class="bg-white shadow-lg rounded-lg flex overflow-hidden">
                <!-- Sidebar -->
                @include('livewire.admin.layouts.sidebar')
                <main class="p-4 w-full">
                    <!-- Page Title -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-3xl font-bold mb-2">Historique des imports</h2>
                        <p class="text-sm opacity-80">Consultez les enregistrements des imports effectués dans le système.</p>
                    </div>

                    <!-- Session Message -->
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 text-green-800 p-4 rounded-lg">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif

                    <!-- Import History Table -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="overflow-x-auto w-full ">
                                <table class="min-w-full table-auto border-collapse border border-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Date</th>
                                            {{-- <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Fichier</th> --}}
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Tag</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Pays</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Total lignes</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Importées</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Ignorées</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Utilisateur</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @forelse($history as $record)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 border-b">{{ $record->created_at->format('d/m/Y H:i') }}</td>
                                                {{-- <td class="px-6 py-4 border-b">
                                                    <span class="text-sm font-semibold text-blue-500">{{ $record->filename ?? 'Non spécifié' }}</span>
                                                </td> --}}
                                                <td class="px-6 py-4 border-b text-blue-500 font-semibold">
                                                    {{ strtoupper($record->tag ?? 'Inconnu') }}
                                                </td>
                                                <td class="px-6 py-4 border-b">
                                                    {{ $record->pays->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 border-b text-gray-700">
                                                    {{ $record->total_records ?? 0 }}
                                                </td>
                                                <td class="px-6 py-4 border-b text-green-600">
                                                    {{ $record->imported_records ?? 0 }}
                                                </td>
                                                <td class="px-6 py-4 border-b text-red-600">
                                                    {{ $record->skipped_records ?? 0 }}
                                                </td>
                                                <td class="px-6 py-4 border-b">
                                                    {{ $record->user_name ?? 'Utilisateur inconnu' }}
                                                </td>
                                                <td class="px-6 py-4 border-b">
                                                    {{ $record->action ?? 'Utilisateur inconnu' }}

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                                    Aucun enregistrement trouvé.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    
                                </table>
                                
                                <div class="flex justify-end mb-4">
                                    <div class="flex justify-end mb-4">
                                        @if($history->count() > 0)
                                            <form action="{{ route('admin.history.deleteAll') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les enregistrements ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                                                    Supprimer tous les enregistrements
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="p-6 bg-gray-50">
                            {{ $history->links('pagination::tailwind') }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
