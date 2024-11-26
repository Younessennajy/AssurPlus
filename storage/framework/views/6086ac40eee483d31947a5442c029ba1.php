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
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div 
                                class="relative group border rounded-lg p-4 bg-white shadow hover:shadow-lg transition-all cursor-pointer"
                                onclick="toggleOptions('<?php echo e($country->id); ?>')">
                                
                                <img 
                                    src="<?php echo e(asset('images/countries/' . strtolower($country->name) . '.png')); ?>" 
                                    alt="<?php echo e($country->name); ?>" 
                                    class="w-16 h-16 mx-auto mb-4">
                                <p class="text-center font-semibold">+<?php echo e($country->indicatif); ?></p>

                                <div 
                                    id="options-<?php echo e($country->id); ?>" 
                                    class="hidden absolute top-0 left-0 w-full h-full bg-white bg-opacity-90 flex flex-col items-center justify-center rounded-lg shadow-lg">
                                    <a 
                                        href="<?php echo e(route('admin.pays.b2b', ['pays' => $country->name])); ?>"
                                        class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        B2B
                                    </a>
                                    <a 
                                        href="<?php echo e(route('admin.pays.b2c', ['pays' => $country->name])); ?>"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        B2C
                                    </a>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
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
<?php endif; ?>

<script>
    function toggleOptions(countryId) {
        document.querySelectorAll("[id^='options-']").forEach(option => {
            option.classList.add('hidden');
        });

        const options = document.getElementById(`options-${countryId}`);
        if (options) {
            options.classList.toggle('hidden');
        }
    }

</script>
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views\user\data\index.blade.php ENDPATH**/ ?>