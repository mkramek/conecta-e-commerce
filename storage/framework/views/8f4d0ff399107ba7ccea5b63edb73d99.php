<?php $__env->startSection('meta_title'); ?>
    <?php echo e($meta_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_desc'); ?>
    <?php echo e($meta_desc); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_author'); ?>
    <?php echo e($meta_author); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_keywords'); ?>
    <?php echo e($meta_keywords); ?>

<?php $__env->stopSection(); ?>
<header class="w-full bg-zinc-600 z-10 sticky top-0 left-0 right-0">
    <?php
        $name_column = "name_$lang";
        $slug_column = "slug_$lang";
    ?>
    <!--[if BLOCK]><![endif]--><?php if($search): ?>
        <div wire:click.self="toggleSearch"
            class="fixed flex justify-center items-center z-10 top-0 left-0 right-0 bg-black bg-opacity-70 text-3xl w-full h-full">
            <div class="min-w-96 min-h-96 bg-white rounded-xl w-[66%] h-[40rem] p-4">
                <div class="flex w-full justify-between items-center">
                    <h1 class="mb-2">Wyszukiwanie</h1>
                    <?php if (isset($component)) { $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $attributes; } ?>
<?php $component = WireUi\Components\Button\Base::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Button\Base::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-2','wire:click' => 'toggleSearch']); ?>
                        <?php if (isset($component)) { $__componentOriginal8fb227d09011c9831b75a18671cea295 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8fb227d09011c9831b75a18671cea295 = $attributes; } ?>
<?php $component = WireUi\Components\Icon\Index::resolve(['name' => 'x-mark'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Icon\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $attributes = $__attributesOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__attributesOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $component = $__componentOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__componentOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
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
                </div>
                <?php if (isset($component)) { $__componentOriginal125559500674abc14ca4c750a63c3764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal125559500674abc14ca4c750a63c3764 = $attributes; } ?>
<?php $component = WireUi\Components\TextField\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\TextField\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['full' => true,'class' => 'w-full','wire:model.live.debounce.500ms' => 'query','placeholder' => 'Wprowadź nazwę produktu']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal125559500674abc14ca4c750a63c3764)): ?>
<?php $attributes = $__attributesOriginal125559500674abc14ca4c750a63c3764; ?>
<?php unset($__attributesOriginal125559500674abc14ca4c750a63c3764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal125559500674abc14ca4c750a63c3764)): ?>
<?php $component = $__componentOriginal125559500674abc14ca4c750a63c3764; ?>
<?php unset($__componentOriginal125559500674abc14ca4c750a63c3764); ?>
<?php endif; ?>
                <div class="overflow-y-auto max-h-[32rem]">
                    <div class="flex gap-2 h-auto flex-wrap justify-stretch mb-4">
                        <!--[if BLOCK]><![endif]--><?php if($searchResults->isEmpty()): ?>
                            <p><?php echo e(__('Brak wyników')); ?></p>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $product_url = route("product.$lang", [
                                    'id' => $result->id,
                                    'slug' => $result->$slug_column,
                                ]);
                            ?>
                            <a href='<?php echo e($product_url); ?>' class="flex items-center justify-start gap-1 w-full hover:bg-zinc-200 p-4 rounded-lg">
                                <img src="<?php echo e($result->images()->orderBy('display_position', 'asc')->first()->url ?? 'https://via.placeholder.com/120x120'); ?>"
                                    class="w-auto h-28"
                                />
                                <p class="text-lg"><?php echo e($result->$name_column); ?></p>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <div class="max-w-screen-lg h-full px-2 mx-auto flex items-stretch justify-center gap-4 flex-wrap lg:flex-nowrap">
        <button wire:click="toggle" class="lg:hidden flex gap-2 pl-2 pr-3 py-1 items-center justify-start fixed top-1 left-1 z-20 text-white">
            <?php if (isset($component)) { $__componentOriginal8fb227d09011c9831b75a18671cea295 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8fb227d09011c9831b75a18671cea295 = $attributes; } ?>
<?php $component = WireUi\Components\Icon\Index::resolve(['name' => ''.e($menu ? 'x-mark' : 'bars-3').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Icon\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $attributes = $__attributesOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__attributesOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $component = $__componentOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__componentOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
        </button>
        <div class="basis-full lg:basis-1/4 flex items-center justify-center lg:justify-start">
            <img src="/img/svg/Con_krzywe_bez_Srodkow.svg" alt="Logo - Conecta" class="h-12 m-2 lg:m-0" />
        </div>
        <div class="basis-full lg:basis-1/2 lg:block <?php echo e($menu ? '' : 'hidden'); ?>">
            <nav class="h-full flex list-none flex-col lg:flex-row items-stretch justify-start lg:justify-center gap-1">
                <li
                    class="<?php echo e(request()->path() === "$lang" ? 'border-b-4 border-b-primary-600' : ''); ?> cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="<?php echo e(route("home.$lang")); ?>"><?php echo e(__('Strona główna')); ?></a>
                </li>
                <li
                    class="<?php echo e(request()->path() === "$lang/products" ? 'border-b-4 border-b-primary-600' : ''); ?> cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="<?php echo e(route("products.$lang")); ?>"><?php echo e(__('Produkty')); ?></a>
                </li>
                <li
                    class="<?php echo e(request()->path() === "$lang/newsletter" ? 'border-b-4 border-b-primary-600' : ''); ?> cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="<?php echo e(route("newsletter.$lang")); ?>"><?php echo e(__('Newsletter')); ?></a>
                </li>
                <li
                    class="<?php echo e(request()->path() === "$lang/blog" ? 'border-b-4 border-b-primary-600' : ''); ?> cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="<?php echo e(route("blog.$lang")); ?>"><?php echo e(__('Blog')); ?></a>
                </li>
                <li class="cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <button wire:click="toggleSearch">
                        <?php if (isset($component)) { $__componentOriginal8fb227d09011c9831b75a18671cea295 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8fb227d09011c9831b75a18671cea295 = $attributes; } ?>
<?php $component = WireUi\Components\Icon\Index::resolve(['name' => 'magnifying-glass'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Icon\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $attributes = $__attributesOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__attributesOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $component = $__componentOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__componentOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
                    </button>
                </li>
            </nav>
        </div>
        <div class="<?php echo e($menu ? 'flex' : 'hidden'); ?> mb-4 lg:mb-0 basis-full lg:basis-1/4 lg:flex justify-center lg:justify-end gap-4 lg:gap-2 items-center">
            <a class="<?php echo e(request()->path() === "$lang/profile" ? 'border-b-[3px] border-b-primary-600 rounded-md' : ''); ?> flex text-white items-center gap-1 text-xs"
                href="<?php echo e(auth()->check() ? route("profile.$lang") : route("login.$lang")); ?>"
            >
                <?php if (isset($component)) { $__componentOriginal8fb227d09011c9831b75a18671cea295 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8fb227d09011c9831b75a18671cea295 = $attributes; } ?>
<?php $component = WireUi\Components\Icon\Index::resolve(['name' => 'user','solid' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Icon\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'white','class' => 'h-8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $attributes = $__attributesOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__attributesOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $component = $__componentOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__componentOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
                <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
                    <span><?php echo e(auth()->user()->name); ?></span>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </a>
            <a class="<?php echo e(request()->path() === "$lang/cart" ? 'border-b-[3px] border-b-primary-600 rounded-md' : ''); ?> relative"
                href="<?php echo e(route("cart.$lang")); ?>"
            >
                <?php if (isset($component)) { $__componentOriginal8fb227d09011c9831b75a18671cea295 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8fb227d09011c9831b75a18671cea295 = $attributes; } ?>
<?php $component = WireUi\Components\Icon\Index::resolve(['name' => 'shopping-cart','solid' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Icon\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'white','class' => 'h-8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $attributes = $__attributesOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__attributesOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8fb227d09011c9831b75a18671cea295)): ?>
<?php $component = $__componentOriginal8fb227d09011c9831b75a18671cea295; ?>
<?php unset($__componentOriginal8fb227d09011c9831b75a18671cea295); ?>
<?php endif; ?>
                <!--[if BLOCK]><![endif]--><?php if($cart_count): ?>
                    <span
                        class="absolute top-0 right-0 text-sm rounded-full bg-red-600 text-white w-4 h-4 flex justify-center items-center"><?php echo e($cart_count); ?></span>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </a>
            <div class="flex gap-1">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = config('lang.available_languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $availableLang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if($lang === $availableLang): ?>
                        <a href="#">
                            <?php if (isset($component)) { $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $attributes; } ?>
<?php $component = WireUi\Components\Button\Base::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Button\Base::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => true,'primary' => true,'class' => 'uppercase']); ?><?php echo e($availableLang); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1)): ?>
<?php $attributes = $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1; ?>
<?php unset($__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1)): ?>
<?php $component = $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1; ?>
<?php unset($__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1); ?>
<?php endif; ?>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e($urls[$availableLang]); ?>">
                            <?php if (isset($component)) { $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1 = $attributes; } ?>
<?php $component = WireUi\Components\Button\Base::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Button\Base::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['light' => true,'zinc' => true,'class' => 'uppercase']); ?><?php echo e($availableLang); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1)): ?>
<?php $attributes = $__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1; ?>
<?php unset($__attributesOriginalf04362c37f55b087f96f1c4fb07d5ce1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1)): ?>
<?php $component = $__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1; ?>
<?php unset($__componentOriginalf04362c37f55b087f96f1c4fb07d5ce1); ?>
<?php endif; ?>
                        </a>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</header>
<?php /**PATH /var/app/ecommerce/resources/views/livewire/header.blade.php ENDPATH**/ ?>