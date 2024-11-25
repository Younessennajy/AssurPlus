<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg flex">
                @include('livewire.admin.layouts.sidebar')
                <main class="p-6 w-full">
                    <div class="container">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier l'enregistrement</h2>

                        <form action="{{ route('admin.data.update', ['pays' => $pays->name, 'type' => $type, 'id' => $data->id]) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            @if($type === 'b2b')
                                <div>
                                    <label for="raison_social" class="block text-sm font-medium text-gray-700">Raison Sociale</label>
                                    <input type="text" id="raison_social" name="raison_social" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('raison_social') border-red-500 @enderror" 
                                        value="{{ old('raison_social', $data->raison_social) }}">
                                    @error('raison_social')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="dirigeant_prenom" class="block text-sm font-medium text-gray-700">Prénom du Dirigeant</label>
                                    <input type="text" id="dirigeant_prenom" name="dirigeant_prenom" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('dirigeant_prenom') border-red-500 @enderror" 
                                        value="{{ old('dirigeant_prenom', $data->dirigeant_prenom) }}">
                                    @error('dirigeant_prenom')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="dirigeant_name" class="block text-sm font-medium text-gray-700">Nom du Dirigeant</label>
                                    <input type="text" id="dirigeant_name" name="dirigeant_name" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('dirigeant_name') border-red-500 @enderror" 
                                        value="{{ old('dirigeant_name', $data->dirigeant_name) }}">
                                    @error('dirigeant_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                                    <input type="text" id="address" name="address" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror" 
                                        value="{{ old('address', $data->address) }}">
                                    @error('address')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700">Code Postal</label>
                                    <input type="text" id="postal_code" name="postal_code" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('postal_code') border-red-500 @enderror" 
                                        value="{{ old('postal_code', $data->postal_code) }}">
                                    @error('postal_code')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                                    <input type="text" id="ville" name="ville" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('ville') border-red-500 @enderror" 
                                        value="{{ old('ville', $data->ville) }}">
                                    @error('ville')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                    <input type="text" id="phone" name="phone" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('phone') border-red-500 @enderror" 
                                        value="{{ old('phone', $data->phone) }}">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gsm" class="block text-sm font-medium text-gray-700">GSM</label>
                                    <input type="text" id="gsm" name="gsm" 
                                        class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('gsm') border-red-500 @enderror" 
                                        value="{{ old('gsm', $data->gsm) }}">
                                    @error('gsm')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            
                            <div class="flex items-center gap-4">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Enregistrer les modifications
                                </button>
                                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                                    Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
