<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-8">
            <a href="<?php echo e(route('admin.locations.show', $location)); ?>" class="text-red-500 hover:text-red-600 mb-4 inline-block">
                ← Back to <?php echo e($location->name); ?>

            </a>

            <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Location</h1>

            <form action="<?php echo e(route('admin.locations.update', $location)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Location Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?php echo e(old('name', $location->name)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Address -->
                <div class="mb-6">
                    <label for="address" class="block text-sm font-bold text-gray-900 mb-2">Address *</label>
                    <input
                        type="text"
                        id="address"
                        name="address"
                        value="<?php echo e(old('address', $location->address)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- City -->
                <div class="mb-6">
                    <label for="city" class="block text-sm font-bold text-gray-900 mb-2">City *</label>
                    <input
                        type="text"
                        id="city"
                        name="city"
                        value="<?php echo e(old('city', $location->city)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- State -->
                <div class="mb-6">
                    <label for="state" class="block text-sm font-bold text-gray-900 mb-2">State/Province</label>
                    <input
                        type="text"
                        id="state"
                        name="state"
                        value="<?php echo e(old('state', $location->state)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                    <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Country -->
                <div class="mb-6">
                    <label for="country" class="block text-sm font-bold text-gray-900 mb-2">Country *</label>
                    <input
                        type="text"
                        id="country"
                        name="country"
                        value="<?php echo e(old('country', $location->country)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Latitude -->
                <div class="mb-6">
                    <label for="latitude" class="block text-sm font-bold text-gray-900 mb-2">Latitude *</label>
                    <input
                        type="number"
                        id="latitude"
                        name="latitude"
                        step="0.000001"
                        value="<?php echo e(old('latitude', $location->latitude)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Longitude -->
                <div class="mb-6">
                    <label for="longitude" class="block text-sm font-bold text-gray-900 mb-2">Longitude *</label>
                    <input
                        type="number"
                        id="longitude"
                        name="longitude"
                        step="0.000001"
                        value="<?php echo e(old('longitude', $location->longitude)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        required
                    >
                    <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-900 mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    ><?php echo e(old('description', $location->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Verified -->
                <div class="mb-6">
                    <label for="verified" class="flex items-center">
                        <input
                            type="checkbox"
                            id="verified"
                            name="verified"
                            value="1"
                            <?php echo e(old('verified', $location->verified) ? 'checked' : ''); ?>

                            class="rounded"
                        >
                        <span class="ml-3 text-sm font-bold text-gray-900">Mark as Verified</span>
                    </label>
                </div>

                <!-- Errors -->
                <?php if($errors->any()): ?>
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <a href="<?php echo e(route('admin.locations.show', $location)); ?>" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-bold">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 font-bold">
                        Update Location
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ridereview\resources\views/admin/locations/edit.blade.php ENDPATH**/ ?>