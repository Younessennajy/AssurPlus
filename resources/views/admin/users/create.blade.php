<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Main Content -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-xl font-semibold mb-4">Create New User</h1>
    
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full border border-gray-300 p-2 rounded" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="w-full border border-gray-300 p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 p-2 rounded" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
</x-app-layout>