<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg flex">
                @include('layouts.sidebar')
                <main class="p-6 w-full">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold mb-4">Historique des imports</h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pays</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tag</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Records</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($history as $record)
                                            <tr>
                                                <td class="px-6 py-4">{{ $record->created_at }}</td>
                                                <td class="px-6 py-4">{{ $record->user->name }}</td>
                                                <td class="px-6 py-4">{{ strtoupper($record->table_type) }}</td>
                                                <td class="px-6 py-4">{{ $record->pays->name }}</td>
                                                <td class="px-6 py-4">{{ $record->tag }}</td>
                                                <td class="px-6 py-4">{{ $record->records_imported }}</td>
                                                <td class="px-6 py-4">{{ $record->is_admin ? 'Oui' : 'Non' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>