<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-white via-gray-50 to-gray-100 shadow-lg rounded-lg flex">
                <!-- Sidebar -->
                @include('livewire.admin.layouts.sidebar')

                <!-- Main Content -->
                <div class="flex-1 p-8">
                    <h1 class="text-2xl font-bold text-gray-700 mb-6 border-b pb-2">Create New User</h1>

                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf
                        <!-- Name Field -->
                        <div class="flex flex-col">
                            <label for="name" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Full Name
                                </span>
                            </label>
                            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="John Doe" value="{{ old('name') }}" required>
                        </div>

                        <!-- Email Field -->
                        <div class="flex flex-col">
                            <label for="email" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Email Address
                                </span>
                            </label>
                            <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="johndoe@example.com" value="{{ old('email') }}" required>
                        </div>

                        <!-- Password Field -->
                        <div class="flex flex-col">
                            <label for="password" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Password
                                </span>
                            </label>
                            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="••••••••" required>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="flex flex-col">
                            <label for="password_confirmation" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Confirm Password
                                </span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="••••••••" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none transition-all duration-200">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
