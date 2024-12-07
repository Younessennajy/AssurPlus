<div class="mt-6 bg-gray-50 p-6 rounded-lg border shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Configuration des colonnes</h3>
        <button type="button" 
                id="toggleAll" 
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-sm">
            Tout afficher/masquer
        </button>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" id="columnToggles">
        <?php if($data->count() > 0): ?>
            <?php $__currentLoopData = $data->first()->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (! (in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))): ?>
                    <label class="inline-flex items-center">
                        <input type="checkbox" 
                               class="column-toggle form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                               data-column="<?php echo e($column); ?>"
                               checked>
                        <span class="ml-2 text-sm text-gray-700"><?php echo e($column); ?></span>
                    </label>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Nouveau dossier\AssurPlus\resources\views\user\data\b2b\filtrage.blade.php ENDPATH**/ ?>