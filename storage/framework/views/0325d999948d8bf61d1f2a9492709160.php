<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Files</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    <div class="card">
                        <div class="card-header">
                            <span><b>File Table:</b></span>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>File</th>
                                        <th>Uploaded By</th>
                                        <th>Uploaded At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($file->file_text); ?></td>
                                        <td><?php echo e(str_replace('project-files/', '', $file->file_name)); ?></td>
                                        <td><?php echo e($file->uploader->fullname); ?></td>
                                        <td><?php echo e(date('M d, Y h:i A',strtotime($file->created_at))); ?></td>
                                        <td>
                                            <a href="<?php echo e(asset($file->file_name)); ?>" class="btn btn-primary btn-sm" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.owner.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/owner/projects/project-files.blade.php ENDPATH**/ ?>