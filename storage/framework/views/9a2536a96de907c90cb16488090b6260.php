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
                <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Main Content -->
                <div class="w-full p-6">
                    <h2 class="text-2xl font-semibold mb-6">Gestion des Colonnes</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Colonnes B2B -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-medium mb-4">Colonnes B2B</h3>
                            <table class="min-w-full bg-white border border-gray-200 rounded-md">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium">Nom de la colonne</th>
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $b2bColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="p-2 border-b border-gray-200 text-sm"><?php echo e($column); ?></td>
                                        <td class="p-2 border-b border-gray-200 text-sm text-center">
                                            <form action="<?php echo e(route('admin.columns.delete')); ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette colonne ?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="hidden" name="type" value="b2b">
                                                <input type="hidden" name="column" value="<?php echo e($column); ?>">
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <!-- Ajouter une colonne -->
                            <form action="<?php echo e(route('admin.columns.add')); ?>" method="POST" class="mt-4">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="type" value="b2b">
                                <label for="b2b_column" class="block text-sm font-medium">Ajouter une colonne</label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        id="b2b_column" 
                                        name="column" 
                                        class="flex-1 border rounded-l-md p-2 focus:outline-none focus:ring focus:border-blue-300" 
                                        placeholder="Nom de la colonne">
                                    <button 
                                        type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-r-md">
                                        Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Colonnes B2C -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-medium mb-4">Colonnes B2C</h3>
                            <table class="min-w-full bg-white border border-gray-200 rounded-md">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium">Nom de la colonne</th>
                                        <th class="p-2 border-b border-gray-200 text-sm font-medium text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $b2cColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="p-2 border-b border-gray-200 text-sm"><?php echo e($column); ?></td>
                                        <td class="p-2 border-b border-gray-200 text-sm text-center">
                                            <form action="<?php echo e(route('admin.columns.delete')); ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette colonne ?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="hidden" name="type" value="b2c">
                                                <input type="hidden" name="column" value="<?php echo e($column); ?>">
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <!-- Ajouter une colonne -->
                            <form action="<?php echo e(route('admin.columns.add')); ?>" method="POST" class="mt-4">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="type" value="b2c">
                                <label for="b2c_column" class="block text-sm font-medium">Ajouter une colonne</label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        id="b2c_column" 
                                        name="column" 
                                        class="flex-1 border rounded-l-md p-2 focus:outline-none focus:ring focus:border-blue-300" 
                                        placeholder="Nom de la colonne">
                                    <button 
                                        type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-r-md">
                                        Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/columns/show.blade.php ENDPATH**/ ?>