</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> </strong>
    All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<?php if (isset($component)) { $__componentOriginal9d57ad0dc6f99e1ae5e29fd903877614 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d57ad0dc6f99e1ae5e29fd903877614 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.js-components','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('js-components'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d57ad0dc6f99e1ae5e29fd903877614)): ?>
<?php $attributes = $__attributesOriginal9d57ad0dc6f99e1ae5e29fd903877614; ?>
<?php unset($__attributesOriginal9d57ad0dc6f99e1ae5e29fd903877614); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d57ad0dc6f99e1ae5e29fd903877614)): ?>
<?php $component = $__componentOriginal9d57ad0dc6f99e1ae5e29fd903877614; ?>
<?php unset($__componentOriginal9d57ad0dc6f99e1ae5e29fd903877614); ?>
<?php endif; ?>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/templates/owner/footer.blade.php ENDPATH**/ ?>