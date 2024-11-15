<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                 @include('admin.layouts.sidebar')
                <main class="flex-1 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">New Users Today</h3>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ \App\Models\User::whereDate('created_at', today())->count() }}
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Active Users</h3>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ \App\Models\User::whereNotNull('email_verified_at')->count() }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>
                        <div class="bg-white shadow-sm rounded-lg">
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>