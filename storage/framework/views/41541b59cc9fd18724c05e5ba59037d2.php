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
            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <main class="p-6 w-full overflow-hidden">
                    <?php if(session('success')): ?>
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="container mx-auto">
                        <div class="mb-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white">
                                <div>
                                    <h1 class="text-3xl font-bold mb-2"><?php echo e($pays->name); ?></h1>
                                    <h2 class="text-xl opacity-90">Données <?php echo e(strtoupper($type)); ?></h2>
                                </div>
                                
                                <!-- Formulaire d'exportation -->
                                <?php echo $__env->make('user.data.b2c.b2c_export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                               
                            </div>

                            <!-- Formulaire d'import -->
                        <?php echo $__env->make('user.data.b2c.b2c_import', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            

                            <!-- Filter-->
                        <?php echo $__env->make('user.data.b2b.filtrage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <!-- Formulaire de recherche -->
                        <?php echo $__env->make('user.data.b2c.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            
                        </div>

                        <!-- Table Container avec scroll horizontal -->
                        <?php echo $__env->make('user.data.b2c.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <!-- Pagination -->
                        <div class="mt-4">
                            <?php echo e($data->appends(request()->query())->links()); ?>

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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\user\data\b2c.blade.php ENDPATH**/ ?>