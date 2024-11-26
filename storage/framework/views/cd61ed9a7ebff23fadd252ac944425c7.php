<div>
    <form wire:submit.prevent="submitMapping">
        <h3 class="text-xl font-semibold mb-4">Map Columns</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th>Column</th>
                    <th>Excel Headers</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $b2bColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($column); ?></td>
                        <td>
                            <select wire:model="mappings.<?php echo e($column); ?>" class="border rounded-md">
                                <option value="">Select Excel Header</option>
                                <?php $__currentLoopData = $excelHeaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($index); ?>"><?php echo e($header); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mt-4">
            Submit Mapping
        </button>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\livewire\admin\import\column-mapping.blade.php ENDPATH**/ ?>