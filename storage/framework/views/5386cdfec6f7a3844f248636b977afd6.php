</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> </strong>
    All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<?php if (isset($component)) { $__componentOriginalb3500933d544b7b180d5e50d473ae23d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb3500933d544b7b180d5e50d473ae23d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.js-member','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('js-member'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb3500933d544b7b180d5e50d473ae23d)): ?>
<?php $attributes = $__attributesOriginalb3500933d544b7b180d5e50d473ae23d; ?>
<?php unset($__attributesOriginalb3500933d544b7b180d5e50d473ae23d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb3500933d544b7b180d5e50d473ae23d)): ?>
<?php $component = $__componentOriginalb3500933d544b7b180d5e50d473ae23d; ?>
<?php unset($__componentOriginalb3500933d544b7b180d5e50d473ae23d); ?>
<?php endif; ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/templates/member/footer.blade.php ENDPATH**/ ?>