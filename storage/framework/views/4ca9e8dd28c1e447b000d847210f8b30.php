<?php $__env->startSection('content'); ?>
<div class="admin-location-detail">
    <div class="header">
        <h1><?php echo e($location->name); ?></h1>
        <a href="<?php echo e(route('admin.locations.index')); ?>" class="back-btn">← Back to Locations</a>
    </div>

    <div class="location-card">
        <!-- Location Info -->
        <div class="section">
            <h3>📋 Location Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <label>Name</label>
                    <p><?php echo e($location->name); ?></p>
                </div>
                <div class="info-item">
                    <label>Address</label>
                    <p><?php echo e($location->address); ?></p>
                </div>
                <div class="info-item">
                    <label>City</label>
                    <p><?php echo e($location->city); ?></p>
                </div>
                <div class="info-item">
                    <label>State</label>
                    <p><?php echo e($location->state ?? 'N/A'); ?></p>
                </div>
                <div class="info-item">
                    <label>Country</label>
                    <p><?php echo e($location->country); ?></p>
                </div>
            </div>
        </div>

        <!-- Coordinates -->
        <div class="section">
            <h3>📍 Coordinates</h3>
            <div class="coordinates-grid">
                <div class="coord-item">
                    <label>Latitude</label>
                    <p class="coord-value"><?php echo e($location->latitude); ?></p>
                </div>
                <div class="coord-item">
                    <label>Longitude</label>
                    <p class="coord-value"><?php echo e($location->longitude); ?></p>
                </div>
            </div>
        </div>

        <!-- Description -->
        <?php if($location->description): ?>
        <div class="section">
            <h3>📝 Description</h3>
            <p><?php echo e($location->description); ?></p>
        </div>
        <?php endif; ?>

        <!-- Status -->
        <div class="section">
            <h3>✓ Verification Status</h3>
            <div class="status-container">
                <?php if($location->verified): ?>
                <span class="status-badge verified">✓ Verified</span>
                <form action="<?php echo e(route('admin.locations.unverify', $location)); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <button type="submit" class="btn btn-secondary">Unverify</button>
                </form>
                <?php else: ?>
                <span class="status-badge pending">⏳ Pending Verification</span>
                <form action="<?php echo e(route('admin.locations.verify', $location)); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <button type="submit" class="btn btn-success">Verify Location</button>
                </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- Attractions -->
        <div class="section">
            <h3>🎢 Attractions (<?php echo e($location->attractions->count()); ?>)</h3>
            <?php if($location->attractions->count() > 0): ?>
            <div class="attractions-grid">
                <?php $__currentLoopData = $location->attractions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attraction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="attraction-card">
                    <h4><?php echo e($attraction->name); ?></h4>
                    <p class="attraction-type"><?php echo e($attraction->type); ?></p>
                    <?php if($attraction->description): ?>
                    <p class="attraction-desc"><?php echo e(Str::limit($attraction->description, 80)); ?></p>
                    <?php endif; ?>
                    <div class="rating-stats">
                        <div class="rating-item">
                            <span class="rating-label">Fun</span>
                            <span class="rating-value"><?php echo e(number_format($attraction->avg_fun_rating, 1)); ?>/10</span>
                        </div>
                        <div class="rating-item">
                            <span class="rating-label">Safety</span>
                            <span class="rating-value"><?php echo e(number_format($attraction->avg_safety_rating, 1)); ?>/10</span>
                        </div>
                        <div class="rating-item">
                            <span class="rating-label">Value</span>
                            <span class="rating-value"><?php echo e(number_format($attraction->avg_value_rating, 1)); ?>/10</span>
                        </div>
                        <div class="rating-item">
                            <span class="rating-label">Reviews</span>
                            <span class="rating-value"><?php echo e($attraction->review_count); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <p class="empty-text">No attractions at this location yet.</p>
            <?php endif; ?>
        </div>

       <!-- Actions -->
        <div class="actions">
            <a href="<?php echo e(route('admin.locations.index')); ?>" class="btn btn-secondary">Back</a>
            <a href="<?php echo e(route('admin.locations.edit', $location)); ?>" class="btn btn-primary">Edit Location</a>
            <a href="<?php echo e(route('admin.attractions.create', $location)); ?>" class="btn btn-success">+ Add Attraction</a>
            <button onclick="confirmDelete()" class="btn btn-delete">Delete Location</button>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this location? All associated attractions will also be deleted.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo e(route('admin.locations.destroy', $location)); ?>';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '<?php echo e(csrf_token()); ?>';

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<style>
    .admin-location-detail {
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
        color: #2C3E50;
    }

    .back-btn {
        color: #FF6B6B;
        text-decoration: none;
        font-weight: 600;
    }

    .location-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .section {
        padding: 2rem;
        border-bottom: 1px solid #eee;
    }

    .section:last-of-type {
        border-bottom: none;
    }

    .section h3 {
        margin: 0 0 1.5rem 0;
        font-size: 1.2rem;
        color: #2C3E50;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .info-item label {
        display: block;
        font-size: 0.85rem;
        color: #999;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .info-item p {
        margin: 0;
        font-size: 1rem;
        color: #2C3E50;
    }

    .coordinates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
    }

    .coord-item {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid #FF6B6B;
    }

    .coord-item label {
        display: block;
        font-size: 0.85rem;
        color: #999;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .coord-value {
        margin: 0;
        font-size: 1.3rem;
        font-weight: bold;
        color: #FF6B6B;
        font-family: monospace;
    }

    .status-container {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-badge.verified {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .attractions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .attraction-card {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid #4ECDC4;
    }

    .attraction-card h4 {
        margin: 0 0 0.5rem 0;
        color: #2C3E50;
        font-size: 1.1rem;
    }

    .attraction-type {
        margin: 0 0 0.5rem 0;
        color: #FF6B6B;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .attraction-desc {
        margin: 0 0 1rem 0;
        color: #666;
        font-size: 0.9rem;
    }

    .rating-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .rating-item {
        background: white;
        padding: 0.75rem;
        border-radius: 6px;
        text-align: center;
    }

    .rating-label {
        display: block;
        font-size: 0.75rem;
        color: #999;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .rating-value {
        display: block;
        font-size: 1rem;
        font-weight: bold;
        color: #FF6B6B;
    }

    .empty-text {
        color: #999;
        text-align: center;
        padding: 2rem;
    }

    .actions {
        display: flex;
        gap: 1rem;
        padding: 2rem;
        border-top: 1px solid #eee;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary {
        background: #e9ecef;
        color: #2C3E50;
    }

    .btn-secondary:hover {
        background: #dee2e6;
    }

    .btn-primary {
        background: #FF6B6B;
        color: white;
    }

    .btn-primary:hover {
        background: #e55a5a;
    }

    .btn-success {
        background: #4ECDC4;
        color: white;
    }

    .btn-success:hover {
        background: #3ab8b0;
    }

    .btn-delete {
        background: #E74C3C;
        color: white;
    }

    .btn-delete:hover {
        background: #c62828;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ridereview\resources\views/admin/locations/show.blade.php ENDPATH**/ ?>