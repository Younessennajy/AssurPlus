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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
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
                        <!-- Colonne Actions -->
                        <td class="px-6 py-4 text-sm text-gray-900 text-right">
                            <!-- Bouton Modifier -->
                            <a href="<?php echo e(route('admin.data.edit', ['pays' => $pays->name, 'type' => $type, 'id' => $row->id])); ?>" 
                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Modifier
                            </a>
                            
                            <!-- Bouton Supprimer -->
                            <form action="<?php echo e(route('admin.data.delete', ['pays' => $pays->name, 'type' => $type, 'id' => $row->id])); ?>" 
                                method="POST">
                              <?php echo csrf_field(); ?>
                              <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')" 
                                        class="px-4 py-2 bg-red-500 text-white text-xs rounded-md hover:bg-red-600">
                                    Supprimer
                                </button>
                            </form>
                        </td>
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
</div><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/data/b2c/list.blade.php ENDPATH**/ ?>