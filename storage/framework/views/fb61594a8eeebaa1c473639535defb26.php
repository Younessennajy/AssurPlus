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
                <main class="flex-1 p-6">
                    <!-- Alerts -->
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show mb-6" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-6" role="alert">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\User::count()); ?></p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">New Users Today</h3>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo e(\App\Models\User::whereDate('created_at', today())->count()); ?>

                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Active Users</h3>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo e(\App\Models\User::whereNotNull('email_verified_at')->count()); ?>

                            </p>
                        </div>
                    </div>
                    <!-- Global Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total B2B</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\B2B::count()); ?></p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total B2C</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\B2C::count()); ?></p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-700">Total Pays</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\Pays::count()); ?></p>
                        </div>
                    </div>

                    <!-- Country Stats -->
                    <?php
                        $pays = \App\Models\Pays::all();
                    ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white p-6 rounded-lg shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4"><?php echo e($pay->name); ?> 
                                    <span class="text-sm text-gray-500">(+<?php echo e($pay->indicatif); ?>)</span>
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-blue-800">B2B</h4>
                                        <p class="text-2xl font-bold text-blue-600">
                                            <?php echo e(\App\Models\B2B::where('pays_id', $pay->id)->count()); ?>

                                        </p>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-green-800">B2C</h4>
                                        <p class="text-2xl font-bold text-green-600">
                                            <?php echo e(\App\Models\B2C::where('pays_id', $pay->id)->count()); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>
                        <div class="bg-white shadow-sm rounded-lg">
                        </div>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>