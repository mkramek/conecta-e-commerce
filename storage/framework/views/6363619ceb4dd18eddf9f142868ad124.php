<div class="h-min-max">
    <section class="w-full mt-4 min-h-full">
        <div class="text-center my-6">
            <h1 class="text-primary-600 text-4xl">
                <b><?php echo e(__('main.products')); ?></b>
            </h1>
        </div>
        <div class="max-w-screen-lg mx-auto mb-6">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product.categories', ['mode' => 'elements']);

$__html = app('livewire')->mount($__name, $__params, 'lw-2726498461-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </section>
</div>
<?php /**PATH /var/app/ecommerce/resources/views/livewire/public/home.blade.php ENDPATH**/ ?>