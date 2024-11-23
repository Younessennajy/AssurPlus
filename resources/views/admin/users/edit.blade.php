<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Main Content -->
                <div class="p-6 w-full  h-screen">
                    <h1 class="text-2xl font-semibold mb-6 text-gray-800 border-b pb-3">Edit User</h1>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Email Field -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                   class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 sm:text-sm" required>
                            @error('email')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <!-- Password Field -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 sm:text-sm">
                            <small class="text-gray-500 block mt-1">Leave blank to keep current password.</small>
                            @error('password')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <!-- Confirm Password Field -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 sm:text-sm">
                        </div>
                
                        <!-- Submit Button -->
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-500">
                            Update User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
