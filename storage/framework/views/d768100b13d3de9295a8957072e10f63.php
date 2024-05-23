<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-4">
        <div class="card card-outline card-success">
            <div class="card-header">
                <b>Project Progress</b>
            </div>
            <div class="card-body">
                <table id="example1" class="table striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Total Task</th>
                            <th>Completed Task</th>
                            <th>Progress</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($project->project_name); ?></td>
                                <td><?php echo e($project->tasks_count); ?></td>
                                <td><?php echo e($project->tasks->where('status', 'Done')->count()); ?></td>
                                <td>
                                    <div class="progress">
                                        <?php if($project->totalPercentage == 100): ?>
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                                                aria-valuemax="100">100%</div>
                                        <?php else: ?>
                                            <div class="progress-bar <?php echo e($project->totalPercentage >= 1 && $project->totalPercentage <= 10 ? 'bg-danger' : ($project->totalPercentage >= 11 && $project->totalPercentage <= 20 ? 'bg-warning' : ($project->totalPercentage >= 21 && $project->totalPercentage <= 40 ? 'bg-info' : 'bg-success'))); ?>"
                                                role="progressbar" style="width: <?php echo e($project->totalPercentage); ?>%;"
                                                aria-valuenow="<?php echo e($project->totalPercentage); ?>" aria-valuemin="0"
                                                aria-valuemax="100"><?php echo e($project->totalPercentage); ?>%</div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $totalPercentage = $project->tasks->sum('percentage');
                                        $completedTasks = $project->tasks->where('status', 'Done')->count();
                                        $totalTasks = $project->tasks->count();
                                    ?>

                                    <?php if($completedTasks > 0 && $totalPercentage == 100): ?>
                                        <span class="badge badge-sm bg-success">Finished</span>
                                    <?php else: ?>
                                        <span class="badge badge-sm bg-danger">Incomplete</span>
                                    <?php endif; ?>
                                </td>



                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.manager.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/manager/reports/view-reports.blade.php ENDPATH**/ ?>