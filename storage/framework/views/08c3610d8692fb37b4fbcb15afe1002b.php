<div>
    <?php
        $column_name = "name_$lang";
        $column_slug = "slug_$lang";
    ?>
    <!--[if BLOCK]><![endif]--><?php if($mode === "list"): ?>
        <div class="flex flex-col">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $primary_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $primary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product.expandable-category-item', ['category' => $primary,'level' => 'primary']);

$__html = app('livewire')->mount($__name, $__params, 'lw-1568984915-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    <?php else: ?>
        <div class="flex flex-wrap justify-center items-start gap-4 mt-6">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $primary_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $attributes; } ?>
<?php $component = WireUi\Components\Button\Base::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Button\Base::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route("products.$lang", ["category_primary" => $category->$column_slug])),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->id),'class' => 'shadow-lg h-52 aspect-square bg-primary-500 hover:border-primary-500 rounded-full text-white hover:text-primary-600 font-bold text-center text-xl break-words p-4 flex flex-col justify-center items-center gap-2']); ?>
                    <!--[if BLOCK]><![endif]--><?php if($category->icon): ?>
                        <img
                            src="<?php echo e($category->icon); ?>"
                            width="100" height="100"
                            alt="Obraz kategorii <?php echo e($category->$column_name); ?>"/>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <span
                        class="<?php echo e(strlen($category->$column_name) > 20 ? 'text-sm' : ''); ?>"><?php echo e($category->$column_name); ?></span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1)): ?>
<?php $attributes = $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1; ?>
<?php unset($__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1)): ?>
<?php $component = $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1; ?>
<?php unset($__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/app/ecommerce/resources/views/livewire/product/categories.blade.php ENDPATH**/ ?>