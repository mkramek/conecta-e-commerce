<div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'soft-scrollbar' => data_get($typeClasses, 'soft-scrollbar', false),
        'hide-scrollbar' => data_get($typeClasses, 'hide-scrollbar', false),
        'fixed inset-0 flex overflow-y-auto sm:pt-16 justify-center',
        $zIndex ?? data_get($typeClasses, 'z-index', 'z-60'),
        $alignClasses,
    ]); ?>"
    x-data="wireui_dialog({ id: '<?php echo e($dialog); ?>' })"
    x-show="show"
    x-on:wireui:<?php echo e($dialog); ?>.window="showDialog($event.detail)"
    x-on:wireui:confirm-<?php echo e($dialog); ?>.window="confirmDialog($event.detail)"
    x-on:keydown.escape.window="handleEscape"
    style="display: none"
    x-cloak>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fixed inset-0 bg-secondary-400 bg-opacity-60 transform transition-opacity',
            'dark:bg-secondary-700 dark:bg-opacity-60',
            $blurClasses => !$blurless,
            "{$dialog}-backdrop",
        ]); ?>"
        x-show="show"
        x-on:click="dismiss"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            $spacing ?? data_get($typeClasses, 'spacing', 'p-4'),
            'w-full transition-all',
            $widthClasses,
        ]); ?>"
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-on:mouseenter="pauseTimeout"
        x-on:mouseleave="resumeTimeout">
        <div class="relative p-4 space-y-4 bg-white shadow-md dark:bg-secondary-800 rounded-xl"
            :class="{
                'sm:p-5 sm:pt-7': style === 'center',
                'sm:p-0 sm:pt-1': style === 'inline',
            }">
            <div class="absolute top-0 left-0 transition-all duration-150 ease-linear rounded-full bg-secondary-300 dark:bg-secondary-600"
                style="height: 2px; width: 100%;"
                x-ref="progressbar"
                x-show="dialog && dialog.progressbar && dialog.timeout">
            </div>

            <div x-show="dialog && dialog.closeButton" class="absolute right-2 -top-2">
                <button class="<?php echo e($dialog); ?>-button-close focus:outline-none p-1 focus:ring-2 focus:ring-secondary-200 rounded-full text-secondary-300"
                    x-on:click="close"
                    type="button">
                    <span class="sr-only">close</span>
                    <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => WireUi::component('icon')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5','name' => 'x-mark']); ?>
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
                </button>
            </div>

            <div class="space-y-4" :class="{ 'sm:space-x-4 sm:flex sm:items-center sm:space-y-0 sm:px-5 sm:py-2': style === 'inline' }">
                <div class="flex items-center self-start justify-center mx-auto shrink-0"
                    :class="{ 'sm:items-start sm:mx-0': style === 'inline' }"
                    x-show="dialog && dialog.icon">
                    <div x-ref="iconContainer"></div>
                </div>

                <div class="w-full mt-4" :class="{ 'sm:mt-5': style === 'center' }">
                    <h3 class="text-lg font-medium leading-6 text-center text-secondary-900 dark:text-secondary-400"
                        :class="{ 'sm:text-left': style === 'inline' }"
                        <?php if (! ($title)): ?> x-ref="title" <?php endif; ?>>
                        <?php echo e($title); ?>

                    </h3>

                    <p class="mt-2 text-sm text-center text-secondary-500"
                        :class="{ 'sm:text-left': style === 'inline' }"
                        <?php if (! ($description)): ?> x-ref="description" <?php endif; ?>>
                        <?php echo e($description); ?>

                    </p>

                    <?php echo e($slot); ?>

                </div>
            </div>

            <div class="grid grid-cols-1 gap-y-2 sm:gap-x-3 rounded-b-xl"
                :class="{
                    'sm:grid-cols-2 sm:gap-y-0': style === 'center',
                    'sm:p-4 sm:bg-secondary-100 sm:dark:bg-secondary-800 sm:grid-cols-none sm:flex sm:justify-end': style === 'inline',
                }"
                x-show="dialog && (dialog.accept || dialog.reject)">
                <div x-show="dialog && dialog.accept" class="sm:order-last" x-ref="accept"></div>
                <div x-show="dialog && dialog.reject" x-ref="reject"></div>
            </div>

            <div class="flex justify-center"
                x-show="dialog && dialog.close && !dialog.accept && !dialog.accept"
                x-ref="close">
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/app/ecommerce/vendor/wireui/wireui/src/Components/Dialog/views/index.blade.php ENDPATH**/ ?>