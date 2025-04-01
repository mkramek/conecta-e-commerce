<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" value="<?php echo e(csrf_token()); ?>">
    <?php if (! empty(trim($__env->yieldContent('meta_title')))): ?>
        <title><?php echo $__env->yieldContent('meta_title'); ?> - <?php echo e(config('app.name')); ?></title>
    <?php else: ?>
        <title><?php echo e(config('app.name')); ?></title>
    <?php endif; ?>
    <?php if (! empty(trim($__env->yieldContent('meta_desc')))): ?>
        <meta name="description" content="<?php echo $__env->yieldContent('meta_desc'); ?>">
    <?php endif; ?>
    <?php if (! empty(trim($__env->yieldContent('meta_keywords')))): ?>
        <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords'); ?>">
    <?php endif; ?>
    <?php if (! empty(trim($__env->yieldContent('meta_author')))): ?>
        <meta name="author" content="<?php echo $__env->yieldContent('meta_author'); ?>">
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(url(asset('favicon.ico'))); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    <?php echo WireUi::directives()->scripts(attributes: []); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>
    <?php if (isset($component)) { $__componentOriginal3dde83133891f87f89e964628fb558b6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3dde83133891f87f89e964628fb558b6 = $attributes; } ?>
<?php $component = WireUi\Components\Notifications\Index::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Notifications\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'top-end']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3dde83133891f87f89e964628fb558b6)): ?>
<?php $attributes = $__attributesOriginal3dde83133891f87f89e964628fb558b6; ?>
<?php unset($__attributesOriginal3dde83133891f87f89e964628fb558b6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3dde83133891f87f89e964628fb558b6)): ?>
<?php $component = $__componentOriginal3dde83133891f87f89e964628fb558b6; ?>
<?php unset($__componentOriginal3dde83133891f87f89e964628fb558b6); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginaladf7d5283c6c06cb103ae62523e6a412 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaladf7d5283c6c06cb103ae62523e6a412 = $attributes; } ?>
<?php $component = WireUi\Components\Dialog\Index::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\WireUi\Components\Dialog\Index::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['z-index' => 'z-50','blur' => 'md','align' => 'center']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaladf7d5283c6c06cb103ae62523e6a412)): ?>
<?php $attributes = $__attributesOriginaladf7d5283c6c06cb103ae62523e6a412; ?>
<?php unset($__attributesOriginaladf7d5283c6c06cb103ae62523e6a412); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaladf7d5283c6c06cb103ae62523e6a412)): ?>
<?php $component = $__componentOriginaladf7d5283c6c06cb103ae62523e6a412; ?>
<?php unset($__componentOriginaladf7d5283c6c06cb103ae62523e6a412); ?>
<?php endif; ?>
    <?php if(Request::path() === app()->getLocale()): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('carousel', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2663507709-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php endif; ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('header', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2663507709-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php echo $__env->yieldContent('body'); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('footer', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2663507709-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wire-elements-modal', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2663507709-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</body>

</html>
<?php /**PATH /var/app/ecommerce/resources/views/layouts/base.blade.php ENDPATH**/ ?>