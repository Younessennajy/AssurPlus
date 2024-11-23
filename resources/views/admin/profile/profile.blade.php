<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row overflow-hidden h-scren">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Main Content -->
                <div class="flex-1 p-8 bg-gradient-to-br from-gray-100 via-gray-50 to-white">
                    <!-- Header -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Modifier mes informations</h1>
                        <p class="text-sm text-gray-600">Mettez à jour votre email ou modifiez votre mot de passe.</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 shadow">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                    
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" 
                                   class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                            @error('email')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <p class="text-gray-500 text-xs mt-1">Laissez vide pour conserver le mot de passe actuel.</p>
                            @error('password')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
