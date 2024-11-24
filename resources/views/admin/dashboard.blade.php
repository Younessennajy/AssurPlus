<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Main Content -->
                <div class="py-6">
                    @if(session('success'))
                    <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('duplicates'))
                    <div class="mb-4 p-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg">
                        {{ count(session('duplicates')) }} lignes sont des doublons et n'ont pas été importées.
                    </div>
                @endif

                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <!-- Stats Globales -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">Total Users</h3>
                                <p class="text-4xl font-bold text-gray-800">{{ $totalUsers }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">New Users Today</h3>
                                <p class="text-4xl font-bold text-gray-800">{{ $newUsersToday }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">Active Users</h3>
                                <p class="text-4xl font-bold text-gray-800">{{ $activeUsers }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">Total Countries</h3>
                                <p class="text-4xl font-bold text-gray-800">{{ $totalPays }}</p>
                            </div>
                        </div>
            
                        <!-- Graphique : Distribution des B2B/B2C par pays -->
                        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">B2B & B2C Distribution by Country</h3>
                            <canvas id="countryChart" height="100"></canvas>
                        </div>
            
                        <!-- Détails par Pays -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($paysStats as $pay)
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">{{ $pay['name'] }} 
                                        <span class="text-sm text-gray-500">(+{{ $pay['indicatif'] }})</span>
                                    </h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-blue-100 p-4 rounded-lg text-center">
                                            <h4 class="text-sm font-medium text-blue-800">B2B</h4>
                                            <p class="text-2xl font-bold text-blue-600">{{ $pay['b2b_count'] }}</p>
                                        </div>
                                        <div class="bg-green-100 p-4 rounded-lg text-center">
                                            <h4 class="text-sm font-medium text-green-800">B2C</h4>
                                            <p class="text-2xl font-bold text-green-600">{{ $pay['b2c_count'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Récupération des données pour Chart.js
                    const countryData = @json($paysChartData);
            
                    const labels = countryData.map(data => data.name);
                    const b2bCounts = countryData.map(data => data.b2b_count);
                    const b2cCounts = countryData.map(data => data.b2c_count);
            
                    const ctx = document.getElementById('countryChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'B2B',
                                    data: b2bCounts,
                                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1,
                                },
                                {
                                    label: 'B2C',
                                    data: b2cCounts,
                                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'B2B and B2C Counts by Country'
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                },
                                y: {
                                    beginAtZero: true,
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

</x-app-layout>


