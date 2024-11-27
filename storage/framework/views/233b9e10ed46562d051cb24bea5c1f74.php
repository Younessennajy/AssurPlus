<div class="w-full overflow-x-auto relative">
    <div class="rounded-lg shadow">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-gray-50">
                <tr>
                    <?php if($data->count() > 0): ?>
                        <?php $__currentLoopData = $data->first()->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (! (in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))): ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider column-header cursor-pointer"
                                    onclick="sortTable('<?php echo e($column); ?>')"
                                    data-column="<?php echo e($column); ?>">
                                    <div class="flex items-center">
                                        <?php echo e($column); ?>

                                        <?php if(isset($sortColumn) && $sortColumn === $column): ?>
                                            <span class="ml-1">
                                                <?php if($sortDirection === 'asc'): ?>
                                                    ↑
                                                <?php else: ?>
                                                    ↓
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </th>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <?php $__currentLoopData = $row->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (! (in_array($column, ['id', 'pays_id', 'created_at', 'updated_at']))): ?>
                                <td class="px-6 py-4 text-sm text-gray-900 column-data"
                                    data-column="<?php echo e($column); ?>">
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

<script>
function sortTable(column) {
    const currentUrl = new URL(window.location.href);
    const currentSort = currentUrl.searchParams.get('sort');
    const currentDirection = currentUrl.searchParams.get('direction');
    
    let newDirection = 'asc';
    
    if (currentSort === column && currentDirection === 'asc') {
        newDirection = 'desc';
    }
    
    currentUrl.searchParams.set('sort', column);
    currentUrl.searchParams.set('direction', newDirection);
    
    window.location.href = currentUrl.toString();
}
</script><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\user\data\b2b\list.blade.php ENDPATH**/ ?>