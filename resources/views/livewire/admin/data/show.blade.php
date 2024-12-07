<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                @include('livewire.admin.layouts.sidebar')
                <main class="p-6 w-full">
                    {{-- Notification en cas d'erreur --}}
                    @if(session('error'))
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- Contenu du formulaire --}}
                    @if(isset($pays))
                        <form action="{{ route('admin.import.process') }}" method="POST" class="p-6">
                            <input type="hidden" name="pays_id" value="{{ $pays->id }}">
                            @csrf

                            <h3 class="text-xl font-semibold mb-4">Mapper les colonnes</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Colonne {{ $type }}
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Colonne Excel
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($type === 'b2b' ? $b2bColumns : $b2cColumns as $column)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $column }}
                                                    @if($column === 'phone')
                                                        <span class="text-red-500">*</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <select name="{{ $type }}_mapping[{{ $column }}]" 
                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                            {{ $column === 'phone' ? 'required' : '' }}>
                                                        <option value="">Sélectionner une colonne</option>
                                                        @foreach($excelHeaders as $index => $header)
                                                            <option value="{{ $index }}">{{ $header }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                            @if(session('duplicates'))
                                <div class="mt-4 bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                                    {{ session('duplicates') }}
                                </div>
                            @endif

                            <div class="mt-6 flex justify-end">
                                <div class="mt-6 flex justify-between">
                                    
                                    <button type="submit" 
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Importer les données
                                    </button>
                                </div>
                        </div>
                        </form>
                    @endif
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
