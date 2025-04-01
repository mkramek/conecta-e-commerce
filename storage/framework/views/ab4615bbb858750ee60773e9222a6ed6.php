<div class="max-w-screen-lg mx-auto">
    <h1 class="text-4xl">Posty</h1>
    <div class="flex flex-col justify-start items-stretch mt-6">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border-y py-4">
                <div class="mb-4 pb-4 flex justify-between items-center border-dashed border-b">
                    <h2 class="text-2xl"><?php echo e($post->title); ?></h2>
                    <div class="text-right">
                        <p>
                            <span>Autor:</span>
                            <span class="font-bold"><?php echo e($post->author); ?></span>
                        </p>
                        <p>
                            <span>Opublikowano:</span>
                            <span class="font-bold"><?php echo e($post->published_at); ?></span>
                        </p>
                    </div>
                </div>
                <div><?php echo $post->content; ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH /var/app/ecommerce/resources/views/livewire/blog/posts.blade.php ENDPATH**/ ?>