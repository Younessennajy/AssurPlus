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
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6">
            <div class="bg-white shadow-lg rounded-lg flex overflow-hidden">
                <!-- Sidebar -->
                <?php echo $__env->make('livewire.admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <main class="p-4 w-full">
                    <!-- Page Title -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-3xl font-bold mb-2">Historique des imports</h2>
                        <p class="text-sm opacity-80">Consultez les enregistrements des imports effectués dans le système.</p>
                    </div>

                    <!-- Session Message -->
                    <?php if(session('success')): ?>
                        <div class="mb-4 bg-green-100 text-green-800 p-4 rounded-lg">
                            <strong><?php echo e(session('success')); ?></strong>
                        </div>
                    <?php endif; ?>

                    <!-- Import History Table -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="overflow-x-auto w-full ">
                                <table class="min-w-full table-auto border-collapse border border-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Date</th>
                                            
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Type</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Pays</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Total lignes</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Importées</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Ignorées</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Utilisateur</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 border-b"><?php echo e($record->created_at->format('d/m/Y H:i')); ?></td>
                                                
                                                <td class="px-6 py-4 border-b text-blue-500 font-semibold">
                                                    <?php echo e(strtoupper($record->table_type ?? 'Inconnu')); ?>

                                                </td>
                                                <td class="px-6 py-4 border-b">
                                                    <?php echo e($record->pays->name ?? 'N/A'); ?>

                                                </td>
                                                <td class="px-6 py-4 border-b text-gray-700">
                                                    <?php echo e($record->total_records ?? 0); ?>

                                                </td>
                                                <td class="px-6 py-4 border-b text-green-600">
                                                    <?php echo e($record->imported_records ?? 0); ?>

                                                </td>
                                                <td class="px-6 py-4 border-b text-red-600">
                                                    <?php echo e($record->skipped_records ?? 0); ?>

                                                </td>
                                                <td class="px-6 py-4 border-b">
                                                    <?php echo e($record->user_name ?? 'Utilisateur inconnu'); ?>

                                                </td>
                                                <td class="px-6 py-4 border-b">
                                                    <?php echo e($record->action ?? 'Utilisateur inconnu'); ?>


                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                                    Aucun enregistrement trouvé.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="p-6 bg-gray-50">
                            <?php echo e($history->links('pagination::tailwind')); ?>

                        </div>
                    </div>
                </main>
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
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\livewire\admin\data\import-history.blade.php ENDPATH**/ ?>