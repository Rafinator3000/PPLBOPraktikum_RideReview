<?php $__env->startSection('content'); ?>
<div class="login-container">
    <div class="login-card">
        <h1>User Login</h1>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                    class="form-input"
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="form-input"
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <p class="already-link">
            <a href="<?php echo e(route('register')); ?>">Don't have an account?</a>
        </p>
        <p class="back-link">
            <a href="<?php echo e(route('home')); ?>">← Back to Home</a>
        </p>
    </div>
</div>

<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #FF6B6B, #4ECDC4);
    }

    .login-card {
        background: white;
        border-radius: 12px;
        padding: 3rem;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .login-card h1 {
        text-align: center;
        margin-bottom: 2rem;
        color: #2C3E50;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #FF6B6B;
        box-shadow: 0 0 0 3px rgba(255,107,107,0.1);
    }

    .checkbox {
        display: flex;
        align-items: center;
        font-weight: normal;
    }

    .checkbox input {
        margin-right: 0.5rem;
    }

    .error {
        color: #E74C3C;
        font-size: 0.9rem;
        margin-top: 0.25rem;
        display: block;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary {
        background: #FF6B6B;
        color: white;
    }

    .btn-primary:hover {
        background: #e55a5a;
        transform: translateY(-2px);
    }

    .already-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .already-link a {
        color: #0d0629;
        text-decoration: none;
        font-weight: 600;
    }

    .back-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .back-link a {
        color: #FF6B6B;
        text-decoration: none;
        font-weight: 600;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ridereview\resources\views/auth/login.blade.php ENDPATH**/ ?>