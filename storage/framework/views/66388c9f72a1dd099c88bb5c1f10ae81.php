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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg flex overflow-hidden">
                <!-- Sidebar -->
                <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <main class="p-8 w-full">
                    <!-- Page Title -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-3xl font-bold mb-2">Historique des imports</h2>
                        <p class="text-sm opacity-80">Consultez les enregistrements des imports effectués dans le système.</p>
                    </div>

                    <!-- Table -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto border-collapse border border-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Date</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Type</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Pays</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Tag</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Utilisateur</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase border-b">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 border-b"><?php echo e($record->created_at->format('d/m/Y H:i')); ?></td>
                                                <td class="px-6 py-4 border-b text-blue-500 font-semibold"><?php echo e(strtoupper($record->table_type)); ?></td>
                                                <td class="px-6 py-4 border-b"><?php echo e($record->pays->name ?? 'N/A'); ?></td>
                                                <td class="px-6 py-4 border-b">
                                                    <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-600">
                                                        <?php echo e($record->tag); ?>

                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 border-b"><?php echo e($record->user_name); ?></td>
                                                <td class="px-6 py-4 border-b">
                                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                                                        <?php echo e($record->action); ?>

                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/data/import-history.blade.php ENDPATH**/ ?>