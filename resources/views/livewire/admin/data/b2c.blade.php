<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                @include('livewire.admin.layouts.sidebar')
                <main class="p-6 w-full overflow-hidden">
                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="container mx-auto">
                        <div class="mb-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white">
                                <div>
                                    <h1 class="text-3xl font-bold mb-2">{{ $pays->name }}</h1>
                                    <h2 class="text-xl opacity-90">Données {{ strtoupper($type) }}</h2>
                                </div>
                                
                                <!-- Formulaire d'exportation -->
                            @include('livewire.admin.data.b2c.b2c_export')
                                
                            </div>

                            <!-- Formulaire d'import -->
                            @include('livewire.admin.data.b2c.b2c_import')
                            

                            <!-- Formulaire de recherche -->
                            @include('livewire.admin.data.b2c.search')
                            
                        </div>

                        <!-- Table Container avec scroll horizontal -->
                        @include('livewire.admin.data.b2c.list')

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $data->appends(request()->query())->links() }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <style>
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }
        
        @media (max-width: 640px) {
            .container {
                padding-left: 0;
                padding-right: 0;
            }
            
            .overflow-x-auto {
                margin-left: -1rem;
                margin-right: -1rem;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</x-app-layout>