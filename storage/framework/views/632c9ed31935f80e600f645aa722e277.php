<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project File Manager</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>
                    Files
                    <button type="button" id="add_btn_i" class="btn btn-primary add_btn float-right">Upload Files</button>
                </h4>
            </div>
            <div class="card-body" id="data_table">
                <?php if($files->isEmpty()): ?>
                    <p>No Files have been Uploaded Yet.</p>
                <?php else: ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h5>Project Name: <?php echo e($details->project_name); ?></h5>
                            <h5>Project Manager: <?php echo e($details->manager->fullname); ?></h5>
                            <h5>Project Owner: <?php echo e($details->owner->fullname); ?></h5>
                        </div>
                    </div>
                </div>
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
                <?php endif; ?>
            </div>
            <div class="card-body d-none" id="file_uploader">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4>Please Fill Up this Form</h4>
                    </div>
                </div>
                <form action="<?php echo e(route('manager.file-upload')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="File">File Name</label>
                        <input type="text" name="file_text" id="file_text" class="form-control" placeholder="Enter File Name">
                    </div>
                    <div class="form-group">
                        <label for="File">File</label>
                        <input type="file" name="file_name" id="file_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="projectId" value="<?php echo e($id); ?>">
                        <button type="submit" class="btn btn-primary btn-block">Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('templates/plugins/jquery/jquery.min.js')); ?>"></script>

<script>
    $(document).ready(function() {
        $('#add_btn_i').on('click', function() {
            $('.add_btn').addClass('d-none');
            $('#data_table').addClass('d-none');
            $('#file_uploader').removeClass('d-none')
        });
    })
</script>


<?php echo $__env->make('templates.manager.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/manager/projects/file-manager.blade.php ENDPATH**/ ?>