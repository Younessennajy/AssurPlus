<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                @include('admin.layouts.sidebar')
                <main class="flex-1 p-6">
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-6" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-6" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
                    <!-- Global Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total B2B</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\B2B::count() }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total B2C</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\B2C::count() }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total Pays</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Pays::count() }}</p>
                        </div>
                    </div>

                    <!-- Country Stats -->
                    @php
                        $pays = \App\Models\Pays::all();
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pays as $pay)
                            <div class="bg-white p-6 rounded-lg shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $pay->name }} 
                                    <span class="text-sm text-gray-500">(+{{ $pay->indicatif }})</span>
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-blue-800">B2B</h4>
                                        <p class="text-2xl font-bold text-blue-600">
                                            {{ \App\Models\B2B::where('pays_id', $pay->id)->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-green-800">B2C</h4>
                                        <p class="text-2xl font-bold text-green-600">
                                            {{ \App\Models\B2C::where('pays_id', $pay->id)->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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