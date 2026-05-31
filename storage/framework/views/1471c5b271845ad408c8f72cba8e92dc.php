<?php $__env->startSection('content'); ?>
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Welcome back, <?php echo e(Auth::user()->name); ?>!</h1>
                        <p class="text-gray-600 mt-2">Ready to explore some attractions?</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Map Link -->
                    <a href="<?php echo e(route('map.index')); ?>" class="block group">
                        <div class="bg-gradient-to-br from-red-500 to-pink-500 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                            <div class="text-4xl mb-3">🗺️</div>
                            <h2 class="text-2xl font-bold mb-2">Explore Map</h2>
                            <p class="text-red-100">Browse attractions and write reviews</p>
                        </div>
                    </a>

                    <!-- Profile Link -->
                    <a href="<?php echo e(route('profile.edit')); ?>" class="block group">
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                            <div class="text-4xl mb-3">👤</div>
                            <h2 class="text-2xl font-bold mb-2">My Profile</h2>
                            <p class="text-blue-100">Update your account information</p>
                        </div>
                    </a>
                </div>

                <!-- Stats -->
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ridereview\resources\views/dashboard.blade.php ENDPATH**/ ?>