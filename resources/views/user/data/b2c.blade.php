<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                @include('layouts.sidebar')
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
                                @include('user.data.b2c.b2c_export')

                               
                            </div>

                            <!-- Formulaire d'import -->
                        @include('user.data.b2c.b2c_import')

                            

                            <!-- Filter-->
                        @include('user.data.b2b.filtrage')

                            <!-- Formulaire de recherche -->
                        @include('user.data.b2c.search')

                            
                        </div>

                        <!-- Table Container avec scroll horizontal -->
                        @include('user.data.b2c.list')

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

        .column-header.hidden,
        .column-data.hidden {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.column-toggle');
            const toggleAllButton = document.getElementById('toggleAll');
            let allChecked = true;

            function updateColumnVisibility(columnName, isVisible) {
                const headers = document.querySelectorAll(`.column-header[data-column="${columnName}"]`);
                const cells = document.querySelectorAll(`.column-data[data-column="${columnName}"]`);
                
                headers.forEach(header => {
                    if (isVisible) {
                        header.classList.remove('hidden');
                    } else {
                        header.classList.add('hidden');
                    }
                });

                cells.forEach(cell => {
                    if (isVisible) {
                        cell.classList.remove('hidden');
                    } else {
                        cell.classList.add('hidden');
                    }
                });
            }

            toggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const column = this.dataset.column;
                    updateColumnVisibility(column, this.checked);
                });
            });

            toggleAllButton.addEventListener('click', function() {
                allChecked = !allChecked;
                toggles.forEach(toggle => {
                    toggle.checked = allChecked;
                    updateColumnVisibility(toggle.dataset.column, allChecked);
                });
            });

            const resetButton = document.querySelector('button[type="reset"]');
            if (resetButton) {
                resetButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = window.location.pathname;
                });
            }
        });
    </script>
</x-app-layout>