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
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-white via-gray-50 to-gray-100 shadow-lg rounded-lg flex">
                <!-- Sidebar -->
                <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Main Content -->
                <div class="flex-1 p-8">
                    <h1 class="text-2xl font-bold text-gray-700 mb-6 border-b pb-2">Create New User</h1>

                    <form method="POST" action="<?php echo e(route('admin.users.store')); ?>" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <!-- Name Field -->
                        <div class="flex flex-col">
                            <label for="name" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Full Name
                                </span>
                            </label>
                            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="John Doe" value="<?php echo e(old('name')); ?>" required>
                        </div>

                        <!-- Email Field -->
                        <div class="flex flex-col">
                            <label for="email" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Email Address
                                </span>
                            </label>
                            <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="johndoe@example.com" value="<?php echo e(old('email')); ?>" required>
                        </div>

                        <!-- Password Field -->
                        <div class="flex flex-col">
                            <label for="password" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Password
                                </span>
                            </label>
                            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="••••••••" required>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="flex flex-col">
                            <label for="password_confirmation" class="mb-2 text-gray-600 font-medium">
                                <span class="flex items-center">
                                    Confirm Password
                                </span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="••••••••" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none transition-all duration-200">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
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
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/users/create.blade.php ENDPATH**/ ?>