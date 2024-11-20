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
                <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <main class="p-6 w-full">
                    <?php if(isset($pays)): ?>
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold mb-4">Import de données - <?php echo e($pays->name); ?></h2>
                            
                            <div class="bg-white rounded-lg shadow">
                                <!-- Messages d'erreur et de succès -->
                                <?php if(session('success')): ?>
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($errors->any()): ?>
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Onglets B2B/B2C -->
                                <div class="border-b">
                                    <nav class="-mb-px flex">
                                        <a href="<?php echo e(route('import.show', ['pays' => $pays->name, 'type' => 'b2b'])); ?>" 
                                           class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm <?php echo e($type === 'b2b' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                            Import B2B
                                        </a>
                                        <a href="<?php echo e(route('import.show', ['pays' => $pays->name, 'type' => 'b2c'])); ?>" 
                                           class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm <?php echo e($type === 'b2c' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                            Import B2C
                                        </a>
                                    </nav>
                                </div>

                                <!-- Formulaire de chargement du fichier -->
                                <?php if(!isset($excelHeaders)): ?>
                                    <div class="p-6">
                                        <div class="max-w-xl">
                                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                                Étape 1: Sélectionner un fichier Excel
                                            </h3>
                                            <form action="<?php echo e(route('import.readHeaders', ['pays' => $pays->name, 'type' => $type])); ?>" 
                                                  method="POST" 
                                                  enctype="multipart/form-data" 
                                                  class="space-y-4">
                                                <?php echo csrf_field(); ?>
                                                <div class="flex flex-col space-y-2">
                                                    <label for="file" class="block text-sm font-medium text-gray-700">
                                                        Fichier Excel (.xlsx, .csv)
                                                    </label>
                                                    <input type="file" 
                                                           id="file"
                                                           name="file" 
                                                           accept=".xlsx,.csv"
                                                           required 
                                                           class="block w-full text-sm text-gray-500
                                                                  file:mr-4 file:py-2 file:px-4
                                                                  file:rounded-md file:border-0
                                                                  file:text-sm file:font-medium
                                                                  file:bg-blue-50 file:text-blue-700
                                                                  hover:file:bg-blue-100" />
                                                </div>
                                                <div class="pt-4">
                                                    <button type="submit" 
                                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        Charger le fichier
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Formulaire de mapping des colonnes -->
                                    <div class="p-6">
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                                            Étape 2: Mapper les colonnes
                                        </h3>
                                        <form action="<?php echo e(route('admin.import.process')); ?>" method="POST" class="space-y-6">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="pays_id" value="<?php echo e($pays->id); ?>">
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Colonne Base de données
                                                            </th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                Colonne Excel
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        <?php $__currentLoopData = $type === 'b2b' ? $b2bColumns : $b2cColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <?php echo e(ucfirst(str_replace('_', ' ', $column))); ?>

                                                                    <?php if(in_array($column, ['tel'])): ?>
                                                                        <span class="text-red-500 ml-1">*</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <select name="<?php echo e($type); ?>_mapping[<?php echo e($column); ?>]" 
                                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                                            <?php echo e(in_array($column, ['tel']) ? 'required' : ''); ?>>
                                                                        <option value="">Sélectionner une colonne</option>
                                                                        <?php $__currentLoopData = $excelHeaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($index); ?>"><?php echo e($header); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="flex justify-end space-x-4">
                                                <a href="<?php echo e(route('import.show', ['pays' => $pays->name, 'type' => $type])); ?>" 
                                                   class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Annuler
                                                </a>
                                                <button type="submit" 
                                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Importer les données
                                                </button>
                                            </div>
                                        </form>
                                        <div class="mt-4 text-sm text-gray-500">
                                            <p><span class="text-red-500">*</span> Champs obligatoires</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/data/show.blade.php ENDPATH**/ ?>