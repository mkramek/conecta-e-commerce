<<?php echo e($tag); ?> <?php echo e($attributes->class([
    'outline-none inline-flex justify-center items-center group hover:shadow-sm',
    'focus:ring-offset-background-white dark:focus:ring-offset-background-dark',
    'transition-all ease-in-out duration-200 focus:ring-2',
    'disabled:opacity-80 disabled:cursor-not-allowed',
    Arr::toRecursiveCssClasses($colorClasses),
    'w-full' => $full,
    $roundedClasses,
    $sizeClasses,
])); ?>>
    <!--[if BLOCK]><![endif]--><?php if($icon): ?>
        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => WireUi::component('icon')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => $icon,'class' => \Illuminate\Support\Arr::toCssClasses([$iconSizeClasses, 'shrink-0'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
    <?php elseif(isset($prepend)): ?>
        <div <?php echo e($prepend->attributes); ?>>
            <?php echo e($prepend); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php echo e($label ?? $slot); ?>


    <!--[if BLOCK]><![endif]--><?php if($rightIcon): ?>
        <?php ($spinnerRemove = $spinnerRemove->merge([
            'name' => $rightIcon,
            'class' => "{$iconSizeClasses} shrink-0",
        ])); ?>
        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => WireUi::component('icon')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => $spinnerRemove]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
    <?php elseif(isset($append)): ?>
        <div <?php echo e($append->attributes); ?> <?php echo e($spinnerRemove); ?>>
            <?php echo e($append); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($spinner): ?>
        <?php if (isset($component)) { $__componentOriginal4cf70504f11b20ffb58b931a3e7b5291 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4cf70504f11b20ffb58b931a3e7b5291 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'wireui-icon::components.spinner','data' => ['attributes' => $spinner,'class' => \Illuminate\Support\Arr::toCssClasses([$iconSizeClasses, 'shrink-0 animate-spin'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wireui-icon::spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($spinner),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([$iconSizeClasses, 'shrink-0 animate-spin']))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4cf70504f11b20ffb58b931a3e7b5291)): ?>
<?php $attributes = $__attributesOriginal4cf70504f11b20ffb58b931a3e7b5291; ?>
<?php unset($__attributesOriginal4cf70504f11b20ffb58b931a3e7b5291); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4cf70504f11b20ffb58b931a3e7b5291)): ?>
<?php $component = $__componentOriginal4cf70504f11b20ffb58b931a3e7b5291; ?>
<?php unset($__componentOriginal4cf70504f11b20ffb58b931a3e7b5291); ?>
<?php endif; ?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</<?php echo e($tag); ?>>

<?php /**PATH /var/app/ecommerce/vendor/wireui/wireui/src/Components/Button/views/base.blade.php ENDPATH**/ ?>