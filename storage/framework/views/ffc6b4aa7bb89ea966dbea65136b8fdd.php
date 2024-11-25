<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                <?php echo $__env->make('livewire.admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- Main Content -->
                <div class="py-6">
                    <?php if(session('success')): ?>
                    <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('duplicates')): ?>
                    <div class="mb-4 p-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg">
                        <?php echo e(count(session('duplicates'))); ?> lignes sont des doublons et n'ont pas été importées.
                    </div>
                <?php endif; ?>

                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <!-- Stats Globales -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">Total Users</h3>
                                <p class="text-4xl font-bold text-gray-800"><?php echo e($totalUsers); ?></p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">New Users Today</h3>
                                <p class="text-4xl font-bold text-gray-800"><?php echo e($newUsersToday); ?></p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">Active Users</h3>
                                <p class="text-4xl font-bold text-gray-800"><?php echo e($activeUsers); ?></p>
                            </div>
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <h3 class="text-sm font-semibold text-gray-600 uppercase">Total Countries</h3>
                                <p class="text-4xl font-bold text-gray-800"><?php echo e($totalPays); ?></p>
                            </div>
                        </div>
            
                        <!-- Graphique : Distribution des B2B/B2C par pays -->
                        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">B2B & B2C Distribution by Country</h3>
                            <canvas id="countryChart" height="100"></canvas>
                        </div>
            
                        <!-- Détails par Pays -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php $__currentLoopData = $paysStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2"><?php echo e($pay['name']); ?> 
                                        <span class="text-sm text-gray-500">(+<?php echo e($pay['indicatif']); ?>)</span>
                                    </h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-blue-100 p-4 rounded-lg text-center">
                                            <h4 class="text-sm font-medium text-blue-800">B2B</h4>
                                            <p class="text-2xl font-bold text-blue-600"><?php echo e($pay['b2b_count']); ?></p>
                                        </div>
                                        <div class="bg-green-100 p-4 rounded-lg text-center">
                                            <h4 class="text-sm font-medium text-green-800">B2C</h4>
                                            <p class="text-2xl font-bold text-green-600"><?php echo e($pay['b2c_count']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Récupération des données pour Chart.js
                    const countryData = <?php echo json_encode($paysChartData, 15, 512) ?>;
            
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>


<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/livewire/admin/dashboard.blade.php ENDPATH**/ ?>