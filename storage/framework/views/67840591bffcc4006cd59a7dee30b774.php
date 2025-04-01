<?php $__env->startSection('body'); ?>
    <main class="min-h-[calc(100vh-26rem)]">
        <?php echo $__env->yieldContent('content'); ?>
        <?php if(isset($slot)): ?>
            <?php echo e($slot); ?>

        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/app/ecommerce/resources/views/layouts/app.blade.php ENDPATH**/ ?>