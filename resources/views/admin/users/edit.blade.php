<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Main Content -->
                <div class="p-4">
                    <h1 class="text-xl font-semibold mb-4">Edit User</h1>
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
                    @endif
                
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('email')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <small class="text-gray-500">Leave blank to keep current password.</small>
                            @error('password')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
</x-app-layout>