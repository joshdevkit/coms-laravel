<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project List</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row">
            <div class="col-m-d-12 col-lg-12 col-sm-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h5>Project Progress</h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($row->id); ?></td>
                                    <td><?php echo e($row->project_name); ?></td>
                                    <td>
                                        <div class="progress">
                                            <?php if($row->totalPercentage == 100): ?>
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100">100%</div>
                                            <?php else: ?>
                                                <div class="progress-bar <?php echo e($row->totalPercentage >= 1 && $row->totalPercentage <= 10 ? 'bg-danger' : ($row->totalPercentage >= 11 && $row->totalPercentage <= 20 ? 'bg-warning' : ($row->totalPercentage >= 21 && $row->totalPercentage <= 40 ? 'bg-info' : 'bg-success'))); ?>"
                                                    role="progressbar" style="width: <?php echo e($row->totalPercentage); ?>%;"
                                                    aria-valuenow="<?php echo e($row->totalPercentage); ?>" aria-valuemin="0"
                                                    aria-valuemax="100"><?php echo e($row->totalPercentage); ?>%</div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($row->totalPercentage == 100): ?>
                                            Finished
                                        <?php else: ?>
                                            <?php echo e($row->status); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('manager.project-details', ['id' => $row->id])); ?>" class="btn btn-sm btn-primary"><i class="fas fa-folder"></i> View</a>
                                        <a href="<?php echo e(route('manager.project-estimator', ['id' => $row->id])); ?>" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Material Used</a>
                                        <a href="<?php echo e(route('manager.project-files', ['id' => $row->id])); ?>" class="btn btn-sm btn-info"><i class="fas fa-folder"></i> File Management</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-center" colspan="5">No Project Available</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.manager.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/manager/projects/project-list.blade.php ENDPATH**/ ?>