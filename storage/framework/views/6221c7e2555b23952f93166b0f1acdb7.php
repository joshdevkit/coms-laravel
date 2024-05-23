<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager | <?php echo e(config('app.name')); ?></title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <script src="<?php echo e(asset('templates/plugins/jquery/jquery.min.js')); ?>"></script>
  <?php if (isset($component)) { $__componentOriginalc8f790ba3050babfde4a2aa7c71bcfe9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8f790ba3050babfde4a2aa7c71bcfe9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.css-components','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('css-components'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8f790ba3050babfde4a2aa7c71bcfe9)): ?>
<?php $attributes = $__attributesOriginalc8f790ba3050babfde4a2aa7c71bcfe9; ?>
<?php unset($__attributesOriginalc8f790ba3050babfde4a2aa7c71bcfe9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8f790ba3050babfde4a2aa7c71bcfe9)): ?>
<?php $component = $__componentOriginalc8f790ba3050babfde4a2aa7c71bcfe9; ?>
<?php unset($__componentOriginalc8f790ba3050babfde4a2aa7c71bcfe9); ?>
<?php endif; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php echo $__env->make('templates.manager.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('templates.manager.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-wrapper">
         <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('templates.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/templates/manager/header.blade.php ENDPATH**/ ?>