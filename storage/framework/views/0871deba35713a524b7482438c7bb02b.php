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
    <div class="min-h-screen flex py-12  justify-center">
        <div class="max-w-7xl w-full sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- Main Content -->
                <div class="bg-white shadow-md sm:rounded-lg w-full h-screen">
                    <!-- Header -->
                    <div class="flex justify-between items-center px-6 py-4 border-b">
                        <h1 class="text-2xl font-bold text-gray-800">User List</h1>
                        <a href="<?php echo e(route('admin.users.create')); ?>" 
                           class="inline-block bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700 transition duration-300">
                            Create User
                        </a>
                    </div>
                    <!-- Flash Messages -->
                    <div class="px-6 py-4">
                        <?php if(session('success')): ?>
                            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Export</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Import</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-sm text-gray-800"><?php echo e($user->id); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-800"><?php echo e($user->name); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-800"><?php echo e($user->email); ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <form id="permissions-form-<?php echo e($user->id); ?>" action="<?php echo e(route('admin.users.updatePermission')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                            <input type="checkbox" name="permissions[export]" value="1" 
                                                class="cursor-pointer rounded border-gray-300 focus:ring-green-500" 
                                                <?php echo e($user->can_export ? 'checked' : ''); ?>

                                                onchange="document.getElementById('permissions-form-<?php echo e($user->id); ?>').submit()">
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" form="permissions-form-<?php echo e($user->id); ?>" 
                                               name="permissions[import]" value="1" 
                                               class="cursor-pointer rounded border-gray-300 focus:ring-green-500" 
                                               <?php echo e($user->can_import ? 'checked' : ''); ?>

                                               onchange="document.getElementById('permissions-form-<?php echo e($user->id); ?>').submit()">
                                    </td>
                                    <td class="px-6 py-4 flex justify-center space-x-4">
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" 
                                           class="text-blue-600 hover:text-blue-800 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="p-6">
                        <?php echo e($users->links()); ?>

                    </div>
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
<?php /**PATH C:\xampp\htdocs\gestion_contrat\resources\views/admin/users/index.blade.php ENDPATH**/ ?>