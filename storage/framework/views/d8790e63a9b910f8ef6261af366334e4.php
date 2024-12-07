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
            <div class="bg-white shadow-lg sm:rounded-lg flex overflow-hidden">
                <!-- Sidebar -->
                <?php echo $__env->make('livewire.admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Main Content -->
                <div class="w-full p-8 bg-gray-50">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b-2 border-blue-500 pb-4">
                        Gestion des Colonnes et Pays
                    </h2>
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
                    <!-- Gestion des Pays -->
                    <div class="mb-12">
                        <h3 class="text-2xl font-semibold text-gray-700 mb-6">Liste des Pays</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 bg-white rounded-lg shadow">
                                <thead>
                                    <tr class="bg-blue-500 text-white text-sm">
                                        <th class="p-3 text-left font-medium">Nom du Pays</th>
                                        <th class="p-3 text-center font-medium">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-blue-50">
                                        <td class="p-3 border-b text-gray-700 text-sm"><?php echo e($country->name); ?></td>
                                        <td class="p-3 border-b text-center">
                                            <form action="<?php echo e(route('admin.pays.delete', $country->id)); ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce pays ?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-md">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Ajouter un Pays -->
                        <form action="<?php echo e(route('admin.pays.add')); ?>" method="POST" class="mt-6 flex gap-4 items-center">
                            <?php echo csrf_field(); ?>
                            <div class="flex-1">
                                <label for="pays" class="block text-sm font-medium text-gray-700 ">Ajouter un pays</label>
                                <input type="text" id="pays" name="pays" 
                                       class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-300"
                                       placeholder="Nom du pays">
                            </div>
                            <div class="flex-1">
                                <label for="indicatif" class="block text-sm font-medium text-gray-700 mb-1">Indicatif (optionnel)</label>
                                <input type="text" id="indicatif" name="indicatif" 
                                       class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-300"
                                       placeholder="+212">
                            </div>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg mt-6">
                                Ajouter
                            </button>
                        </form>
                    </div>

                    <!-- Gestion des Colonnes -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Colonnes B2B -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Colonnes B2B</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-300 bg-gray-50 rounded-lg shadow">
                                    <thead>
                                        <tr class="bg-blue-500 text-white text-sm">
                                            <th class="p-3 text-left font-medium">Nom de la Colonne</th>
                                            <th class="p-3 text-center font-medium">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $b2bColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-blue-50">
                                            <td class="p-3 border-b text-gray-700 text-sm"><?php echo e($column); ?></td>
                                            <td class="p-3 border-b text-center">
                                                <form action="<?php echo e(route('admin.columns.delete')); ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette colonne ?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="type" value="b2b">
                                                    <input type="hidden" name="column" value="<?php echo e($column); ?>">
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-md">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Ajouter une Colonne -->
                            <form action="<?php echo e(route('admin.columns.add')); ?>" method="POST" class="mt-6 flex items-center gap-4">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="type" value="b2b">
                                <input type="text" id="b2b_column" name="column" 
                                       class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-300"
                                       placeholder="Nom de la colonne">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                                    Ajouter
                                </button>
                            </form>
                        </div>

                        <!-- Colonnes B2C -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Colonnes B2C</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-300 bg-gray-50 rounded-lg shadow">
                                    <thead>
                                        <tr class="bg-blue-500 text-white text-sm">
                                            <th class="p-3 text-left font-medium">Nom de la Colonne</th>
                                            <th class="p-3 text-center font-medium">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $b2cColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-blue-50">
                                            <td class="p-3 border-b text-gray-700 text-sm"><?php echo e($column); ?></td>
                                            <td class="p-3 border-b text-center">
                                                <form action="<?php echo e(route('admin.columns.delete')); ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette colonne ?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="type" value="b2c">
                                                    <input type="hidden" name="column" value="<?php echo e($column); ?>">
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-md">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Ajouter une Colonne -->
                            <form action="<?php echo e(route('admin.columns.add')); ?>" method="POST" class="mt-6 flex items-center gap-4">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="type" value="b2c">
                                <input type="text" id="b2c_column" name="column" 
                                       class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-300"
                                       placeholder="Nom de la colonne">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                                    Ajouter
                                </button>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Nouveau dossier\AssurPlus\resources\views\livewire\admin\columns\show.blade.php ENDPATH**/ ?>