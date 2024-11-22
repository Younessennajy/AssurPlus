<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')

                <!-- Main Content -->
                <div class="w-full p-6">
                    <h2 class="text-2xl font-semibold mb-6">Gestion des Colonnes et Pays</h2>

                    <!-- Gestion des pays -->
                    <div class="mb-8">
                        <h3 class="text-xl font-medium mb-4">Liste des Pays</h3>
                        <table class="min-w-full bg-white border border-gray-200 rounded-md">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="p-2 border-b border-gray-200 text-sm font-medium">Nom du Pays</th>
                                    <th class="p-2 border-b border-gray-200 text-sm font-medium text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pays as $country)
                                <tr>
                                    <td class="p-2 border-b border-gray-200 text-sm">{{ $country->name }}</td>
                                    <td class="p-2 border-b border-gray-200 text-sm text-center">
                                        <form action="{{ route('admin.pays.delete', $country->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce pays ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <!-- Ajouter un pays -->
                        <form action="{{ route('admin.pays.add') }}" method="POST" class="mt-4">
                            @csrf
                            <label for="pays" class="block text-sm font-medium">Ajouter un pays</label>
                            <div class="flex items-center mt-2">
                                <input 
                                    type="text" 
                                    id="pays" 
                                    name="pays" 
                                    class="flex-1 border rounded-l-md p-2 focus:outline-none focus:ring focus:border-blue-300" 
                                    placeholder="Nom du pays">
                                    <div class="mt-4">
                                        <label for="indicatif" class="block text-sm font-medium">Indicatif (optionnel)</label>
                                        <input type="text" name="indicatif" id="indicatif" class="border p-2 rounded">
                                    </div>
                                <button 
                                    type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-r-md">
                                    Ajouter
                                </button>
                            </div>
                            
                        </form>
                    </div>

                    <!-- Gestion des Colonnes -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Colonnes B2B -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-medium mb-4">Colonnes B2B</h3>
                            <table class="min-w-full bg-white border border-gray-200 rounded-md">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium">Nom de la colonne</th>
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($b2bColumns as $column)
                                    <tr>
                                        <td class="p-2 border-b border-gray-200 text-sm">{{ $column }}</td>
                                        <td class="p-2 border-b border-gray-200 text-sm text-center">
                                            <form action="{{ route('admin.columns.delete') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette colonne ?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="type" value="b2b">
                                                <input type="hidden" name="column" value="{{ $column }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ajouter une colonne -->
                            <form action="{{ route('admin.columns.add') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="type" value="b2b">
                                <label for="b2b_column" class="block text-sm font-medium">Ajouter une colonne</label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        id="b2b_column" 
                                        name="column" 
                                        class="flex-1 border rounded-l-md p-2 focus:outline-none focus:ring focus:border-blue-300" 
                                        placeholder="Nom de la colonne">
                                    <button 
                                        type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-r-md">
                                        Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Colonnes B2C -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-medium mb-4">Colonnes B2C</h3>
                            <table class="min-w-full bg-white border border-gray-200 rounded-md">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium">Nom de la colonne</th>
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($b2cColumns as $column)
                                    <tr>
                                        <td class="p-2 border-b border-gray-200 text-sm">{{ $column }}</td>
                                        <td class="p-2 border-b border-gray-200 text-sm text-center">
                                            <form action="{{ route('admin.columns.delete') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette colonne ?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="type" value="b2c">
                                                <input type="hidden" name="column" value="{{ $column }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ajouter une colonne -->
                            <form action="{{ route('admin.columns.add') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="type" value="b2c">
                                <label for="b2c_column" class="block text-sm font-medium">Ajouter une colonne</label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        id="b2c_column" 
                                        name="column" 
                                        class="flex-1 border rounded-l-md p-2 focus:outline-none focus:ring focus:border-blue-300" 
                                        placeholder="Nom de la colonne">
                                    <button 
                                        type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-r-md">
                                        Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
