<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <?php if(session()->has('error')): ?>
                    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session()->has('success')): ?>
                    <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <div class="bg-gray-50 p-6 rounded-lg border mt-6 shadow-sm">
                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <div class="flex-grow w-full">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Importer un fichier Excel
                            </label>
                            <input type="file" 
                                   wire:model="file"
                                   id="file"
                                   accept=".xlsx,.xls,.csv"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100
                                          cursor-pointer">
                        </div>
                    </div>
                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if($excelHeaders && $pays): ?>
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-4">Mapper les colonnes</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Colonne <?php echo e($type); ?>

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
                                                <?php echo e($column); ?>

                                                <?php if($column === 'phone'): ?>
                                                    <span class="text-red-500">*</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <select wire:model="<?php echo e($type); ?>_mapping.<?php echo e($column); ?>"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                        <?php echo e($column === 'phone' ? 'required' : ''); ?>>
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

                        <?php if($checkDuplicatesResult): ?>
                            <div class="mt-4 bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                                <?php echo e($checkDuplicatesResult); ?>

                            </div>
                        <?php endif; ?>

                        <div class="mt-6 flex justify-between">
                            <button wire:click="checkDuplicates" 
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                Vérifier les doublons
                            </button>
                            <button wire:click="processImport" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Importer les données
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\livewire\admin\import-data.blade.php ENDPATH**/ ?>