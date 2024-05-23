<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Material Used</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h5>Project Materials
                            
                        </h5>
                    </div>
                    <div class="card-body" id="data_table">
                        <?php if($materials->isEmpty()): ?>
                            <p>No Materials have been added yet.</p>
                            
                        <?php else: ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text">
                                    <h5>Project Name: <?php echo e($details->project_name); ?></h5>
                                    <h5>Project Manager: <?php echo e($details->manager->fullname); ?></h5>
                                    <h5>Project Owner: You own this Project</h5>
                                    <h5>Project Cost: <?php echo e(number_format($details->total_budget,2)); ?></h5>

                                    <h5>Project Remaining Balance: <?php echo e(number_format(($details->total_budget - $overallTotal), 2)); ?></h5>

                                </div>
                            </div>
                        </div>
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Category/Section</th>
                                    <th>Materials</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($material->category_section); ?></td>
                                    <td><?php echo e($material->item_name); ?></td>
                                    <td><?php echo e($material->quantity); ?></td>

                                    <td><?php echo e($material->unit); ?></td>
                                    <td><?php echo e(number_format($material->total_price),2); ?></td>
                                    <td><?php echo e(number_format($material->total_price * $material->quantity, 2)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-secondary">
                                    <th colspan="5">Overall Total:</th>
                                    <th colspan="1">
                                        <?php
                                            $overallTotal = 0;
                                            foreach ($materials as $material) {
                                                $overallTotal += $material->total_price * $material->quantity;
                                            }
                                            echo number_format($overallTotal, 2);
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('templates/plugins/jquery/jquery.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.owner.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/owner/projects/project-materials.blade.php ENDPATH**/ ?>