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
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $percentage = $project->tasks->first()->percentage ?? 0;
                                $status = '';

                                if ($percentage < 20) {
                                    $status = 'Incomplete';
                                    $statusClass = 'badge-danger'; // Red color for incomplete
                                } elseif ($percentage == 100) {
                                    $status = 'Done';
                                    $statusClass = 'badge-success'; // Green color for done
                                } else {
                                    $remainingPercentage = 100 - $percentage;
                                    $status = "Incomplete ({$remainingPercentage}% More)";
                                    $statusClass = 'badge-primary'; // Blue color for on-going
                                }
                            ?>
                            <tr>
                                <td><?php echo e($project->id); ?></td>
                                <td><?php echo e($project->project_name); ?></td>
                                <td><?php echo e($project->tasks_count); ?></td>
                                <td><?php echo e($project->tasks->where('status', 'Done')->count() ?? 0); ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($percentage); ?>%;"
                                            aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?php echo e($percentage); ?>%</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge <?php echo e($statusClass); ?>"><?php echo e($status); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/admin/reports/view-reports.blade.php ENDPATH**/ ?>