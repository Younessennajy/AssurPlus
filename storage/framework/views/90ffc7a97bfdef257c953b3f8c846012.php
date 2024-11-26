<div>
    <form wire:submit.prevent="upload">
        <input type="file" wire:model="file" class="mb-4">
        <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Upload File
        </button>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\livewire\admin\import\import-excel.blade.php ENDPATH**/ ?>