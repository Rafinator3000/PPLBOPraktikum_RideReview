<?php $__env->startSection('content'); ?>
<div class="admin-locations">
    <div class="header">
        <h1>📍 Manage Locations</h1>
        <div class="header-actions">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="back-btn">← Back to Dashboard</a>
            <a href="<?php echo e(route('admin.locations.create')); ?>" class="btn btn-primary">+ Add Location</a>
        </div>
    </div>

    <?php if(session('success')): ?>
    <div class="success-message">
        ✓ <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="location-list">
        <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="location-item">
            <div class="location-info">
                <h3><?php echo e($location->name); ?></h3>
                <p class="location-meta"><?php echo e($location->address); ?>, <?php echo e($location->city); ?>, <?php echo e($location->state); ?></p>
                <p class="location-desc"><?php echo e(Str::limit($location->description, 100)); ?></p>
                <div class="location-stats">
                    <span>🎢 <?php echo e($location->attractions->count()); ?> attractions</span>
                    <span><?php echo e($location->verified ? '✅ Verified' : '⏳ Pending'); ?></span>
                </div>
            </div>
            <div class="location-actions">
                <a href="<?php echo e(route('admin.locations.show', $location)); ?>" class="btn btn-view">View</a>
                <form action="<?php echo e(route('admin.locations.destroy', $location)); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this location?')">Delete</button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
            <p>No locations found</p>
            <a href="<?php echo e(route('admin.locations.create')); ?>" class="btn btn-primary">Add Location</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .admin-locations {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #eee;
    }

    .header h1 {
        margin: 0;
        font-size: 2rem;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .back-btn {
        color: #FF6B6B;
        text-decoration: none;
        font-weight: 600;
    }

    .success-message {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .location-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .location-item {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: box-shadow 0.3s;
    }

    .location-item:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }

    .location-info {
        flex: 1;
    }

    .location-item h3 {
        margin: 0 0 0.5rem 0;
        color: #2C3E50;
        font-size: 1.3rem;
    }

    .location-meta {
        color: #FF6B6B;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
    }

    .location-desc {
        color: #666;
        margin: 0 0 1rem 0;
        font-size: 0.95rem;
    }

    .location-stats {
        display: flex;
        gap: 1.5rem;
        font-size: 0.9rem;
        color: #666;
    }

    .location-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view {
        background: #4ECDC4;
        color: white;
    }

    .btn-delete {
        background: #E74C3C;
        color: white;
    }

    .btn-primary {
        background: #FF6B6B;
        color: white;
        padding: 12px 24px;
    }

    .btn-view:hover {
        background: #3ab8b0;
    }

    .btn-delete:hover {
        background: #c62828;
    }

    .btn-primary:hover {
        background: #e55a5a;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #999;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ridereview\resources\views/admin/locations/index.blade.php ENDPATH**/ ?>