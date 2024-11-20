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
                <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <main class="p-6 w-full overflow-hidden">
                    <div class="container mx-auto">
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold">Données <?php echo e(strtoupper($type)); ?> - <?php echo e($pays->name); ?></h2>
                            <form action="<?php echo e(route('admin.import.readHeaders', ['pays' => $pays->name, 'type' => 'b2b'])); ?>" 
                                method="POST" 
                                enctype="multipart/form-data" 
                                class="bg-gray-50 p-4 rounded-lg border mt-4">
                              <?php echo csrf_field(); ?>
                              <div class="flex items-center gap-4">
                                  <div class="flex-grow">
                                      <label for="file" class="block text-sm font-medium text-gray-700 mb-1">
                                          Importer un fichier Excel
                                      </label>
                                      <input type="file" 
                                             id="file"
                                             name="file" 
                                             accept=".xlsx,.xls,.csv"
                                             class="block w-full text-sm text-gray-500
                                                    file:mr-4 file:py-2 file:px-4
                                                    file:rounded-md file:border-0
                                                    file:text-sm file:font-semibold
                                                    file:bg-blue-50 file:text-blue-700
                                                    hover:file:bg-blue-100" 
                                             required>
                                  </div>
                                  <button type="submit" 
                                          class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                      Charger
                                  </button>
                              </div>
                              <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                  <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </form>
                            <form action="<?php echo e(route('admin.pays.' . $type, ['pays' => $pays->name])); ?>" method="GET" class="mt-4">
                                <div class="flex gap-2">
                                    <input type="text" 
                                           name="search" 
                                           value="<?php echo e(request('search')); ?>"
                                           class="w-80 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Rechercher...">
                                    <button type="submit" 
                                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Rechercher
                                    </button>
                                </div>
                            </form>
                        </div>
                    
                        <!-- Table Container avec scroll horizontal -->
                        <div class="w-full overflow-x-auto relative">
                            <div class="rounded-lg shadow">
                                
                                <table class="w-full whitespace-nowrap">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <?php if($data->count() > 0): ?>
                                                <?php $__currentLoopData = $data->first()->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if (! (in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))): ?>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            <?php echo e($column); ?>

                                                        </th>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                                    Aucune donnée disponible
                                                </th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="hover:bg-gray-50">
                                                <?php $__currentLoopData = $row->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if (! (in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))): ?>
                                                        <td class="px-6 py-4 text-sm text-gray-900">
                                                            <?php echo e($value); ?>

                                                        </td>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td class="px-6 py-4 text-sm text-gray-500 text-center" colspan="100%">
                                                    Aucun enregistrement trouvé
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/data/b2b.blade.php ENDPATH**/ ?>