<form action="<?php echo e(route('admin.import.readHeaders', ['pays' => $pays->name, 'type' => 'b2c'])); ?>" 
    method="POST" 
    enctype="multipart/form-data" 
    class="bg-gray-50 p-6 rounded-lg border mt-6 shadow-sm">
  <?php echo csrf_field(); ?>
  <div class="flex flex-col md:flex-row items-center gap-4">
      <div class="flex-grow w-full">
          <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
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
                        hover:file:bg-blue-100
                        cursor-pointer" 
                 required>
      </div>
      <button type="submit" 
              class="w-full md:w-auto px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200 flex items-center justify-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
          </svg>
          Charger
      </button>
  </div>
  <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</form><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/livewire/admin/data/b2c/b2c_import.blade.php ENDPATH**/ ?>