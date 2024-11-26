<div>
    <h3 class="text-xl font-semibold mb-4">Duplicate Check</h3>
    <p>Total Records: <?php echo e($totalRecords); ?></p>
    <p>Duplicates Found: <?php echo e(count($duplicates)); ?></p>
    <ul>
        <?php $__currentLoopData = $duplicates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($phone); ?> appears <?php echo e($count); ?> times</li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\livewire\admin\import\check-duplicates.blade.php ENDPATH**/ ?>