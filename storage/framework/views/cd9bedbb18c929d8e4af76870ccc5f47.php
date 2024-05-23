<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Profile</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Account Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('manager.update-account')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="avatar">Avatar</label>
                                            <div class="custom-file">
                                                <input type="file" name="avatar" id="avatar"
                                                    class="custom-file-input <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                                                <label class="custom-file-label" for="avatar">Choose file</label>
                                            </div>
                                            <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center">
                                            <img id="avatar-preview"
                                                src="<?php echo e(asset($user->avatar)); ?>"
                                                alt="Avatar Preview" class="img-fluid rounded-circle"
                                                style="height: 15vh; width: 15vh; border: 1px solid #dee2e6 !important">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Current Password</label>
                                            <input type="password" name="current_password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        </div>
                                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <div class="col-md-12 mb-3">
                                            <label for="">New Password</label>
                                            <input type="password" name="new_password" class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        </div>
                                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <div class="col-md-12 mb-3">
                                            <label for="">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        </div>
                                        <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                            <label for="fullname">Fullname</label>
                                            <input value="<?php echo e($user->fullname); ?>" type="text" name="fullname" id="fullname" class="form-control <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                            <label for="emailAddress">Email Address</label>
                                            <input value="<?php echo e($user->email); ?>" type="text" name="emailAddress" id="emailAddress" class="form-control <?php $__errorArgs = ['emailAddress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                            <label for="userType">User Type</label>
                                            <input readonly type="text" name="userType" id="userType" class="form-control" placeholder="<?php echo e($user->type == 2 ? 'Manager' : ($user->type == 1 ? 'Admin' : ($user->type == 3 ? 'Project Member' : ($user->type == 0 ? 'Project Owner' : 'Unknown Role')))); ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary float-right" type="submit">Update Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var img = document.getElementById('avatar-preview');
            img.src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    });
</script>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('templates.manager.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/manager/profile/account-settings.blade.php ENDPATH**/ ?>