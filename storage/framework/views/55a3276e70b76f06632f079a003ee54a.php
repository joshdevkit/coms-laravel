<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Details</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    <?php if(session('message')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('message')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-text="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Project Name</b></dt>
                                    <dd><?php echo e($details->project_name); ?></dd>
                                    <dt><b class="border-bottom border-primary">Description</b></dt>
                                    <dd><?php echo e($details->description); ?></dd>
                                    <dt><b class="border-bottom border-primary">Project Location</b></dt>
                                    <?php
                                        $location = unserialize($details->project_location_text);
                                    ?>
                                    <dd>
                                        <?php if(is_array($location)): ?>
                                            <strong>Region:</strong> <?php echo e($location['region']); ?><br>
                                            <strong>Province:</strong> <?php echo e($location['province']); ?><br>
                                            <strong>City:</strong> <?php echo e($location['city']); ?><br>
                                            <strong>Barangay:</strong> <?php echo e($location['barangay']); ?>

                                        <?php else: ?>
                                            Not Available
                                        <?php endif; ?>
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Start Date</b></dt>
                                    <dd><?php echo e(date('F m, Y', strtotime($details->start_date))); ?></dd>
                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">End Date</b></dt>
                                    <dd><?php echo e(date('F m, Y', strtotime($details->end_date))); ?></dd>
                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">Status</b></dt>
                                    <dd>
                                        <?php if($details->status == 'Pending'): ?>
                                            <span class='badge badge-secondary'><?php echo e($details->status); ?></span>
                                        <?php elseif($details->status == 'Started'): ?>
                                            <span class='badge badge-primary'><?php echo e($details->status); ?></span>
                                        <?php elseif($details->status == 'On-Progress'): ?>
                                            <span class='badge badge-info'><?php echo e($details->status); ?></span>
                                        <?php elseif($details->status == 'On-Hold'): ?>
                                            <span class='badge badge-warning'><?php echo e($details->status); ?></span>
                                        <?php elseif($details->status == 'Over Due'): ?>
                                            <span class='badge badge-danger'><?php echo e($details->status); ?></span>
                                        <?php elseif($details->status == 'Done'): ?>
                                            <span class='badge badge-success'><?php echo e($details->status); ?></span>
                                        <?php endif; ?>
                                    </dd>

                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">Project Manager</b></dt>
                                    <dd>

                                        <div class="d-flex align-items-center mt-1">
                                            <img class="img-circle img-thumbnail p-0 shadow-sm border-info img-sm mr-3"
                                                src="<?php echo e(asset($details->manager->avatar)); ?>" alt="Avatar">
                                            <?php if(auth()->check() && $details->manager->fullname == auth()->user()->fullname): ?>
                                                <b>You</b>
                                            <?php else: ?>
                                                <b>Mr./Mrs. <?php echo e($details->manager->fullname); ?></b>
                                            <?php endif; ?>
                                        </div>
                                    </dd>
                                    <dt><b class="border-bottom border-primary">Project Owner</b></dt>
                                    <dd>

                                        <div class="d-flex align-items-center mt-1">
                                            <img class="img-circle img-thumbnail p-0 shadow-sm border-info img-sm mr-3"
                                                src="<?php echo e(asset($details->owner->avatar)); ?>" alt="Avatar">
                                            <b>Mr./Mrs. <?php echo e($details->owner->fullname); ?></b>
                                        </div>

                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <span><b>Team Member/s:</b></span>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="users-list clearfix">
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <img class="w-50" style="height: 50px;" src="<?php echo e(asset($member->members->avatar)); ?>"
                                        alt="User Image">
                                    <p class="d-flex inline-block"><?php echo e($member->members->fullname); ?></p>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <span><b>Task List:</b></span>
                        <button type="button" data-toggle="modal" data-target="#addNewTask"
                            class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> New
                            Task
                        </button>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="example1" class="table table-condensed m-0 table-hover">
                                <colgroup>
                                    <col width="5%">
                                    <col width="25%">
                                    <col width="30%">
                                    <col width="15%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Member Associated</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                                            unset($trans["\""], $trans['<'], $trans['>'], $trans['<h2']);
                                            $desc = strtr(html_entity_decode($task->description), $trans);
                                            $desc = str_replace(['<li>', '</li>', '&nbsp;'], ['', ', ', ' '], $desc);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($task->id); ?></td>
                                            <td class=""><b><?php echo e($task->task_name); ?></b></td>
                                            <td><?php echo e($task->taskfor->fullname); ?></td>
                                            <td class="">
                                                <p class="truncate"><?php echo e(strip_tags($desc)); ?></p>
                                            </td>
                                            <td>
                                                <?php if($task->status == 'Pending'): ?>
                                                    <span class='badge badge-secondary'><?php echo e($task->status); ?></span>
                                                <?php elseif($task->status == 'Started'): ?>
                                                    <span class='badge badge-primary'><?php echo e($task->status); ?></span>
                                                <?php elseif($task->status == 'On-Progress'): ?>
                                                    <span class='badge badge-info'><?php echo e($task->status); ?></span>
                                                <?php elseif($task->status == 'On-Hold'): ?>
                                                    <span class='badge badge-warning'><?php echo e($task->status); ?></span>
                                                <?php elseif($task->status == 'Over Due'): ?>
                                                    <span class='badge badge-danger'><?php echo e($task->status); ?></span>
                                                <?php elseif($task->status == 'Done'): ?>
                                                    <span class='badge badge-success'><?php echo e($task->status); ?></span>
                                                <?php endif; ?>
                                                </dd>
                                            </td>
                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="true">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" style="">
                                                    <div class="dropdown-divider"></div>
                                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#editUserTask_<?php echo e($task->id); ?>">Edit</button>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_task" href="javascript:void(0)"
                                                        data-id="<?php echo e($task->id); ?>">Delete</a>
                                                </div>

                                            </td>
                                            <div class="modal fade" id="editUserTask_<?php echo e($task->id); ?>" tabindex="-1"
                                                aria-labelledby="editTaskLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editTaskLabel">Edit Task</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="<?php echo e(route('manager.update-task')); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="form-group">
                                                                    <label for="task_name">Task</label>
                                                                    <input type="text" name="task_name"
                                                                        value="<?php echo e($task->task_name); ?>"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="member_id">Assign To</label>
                                                                    <select name="member_id" id="member_id" class="form-control">
                                                                        <option value="">Select Member</option>
                                                                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($member->members->id); ?>" <?php echo e($member->members->id == $task->member_id ? 'selected' : ''); ?>>
                                                                                <?php echo e($member->members->fullname); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea disabled class=" form-control summernote" name="description_selected" id="description_selected"
                                                                        cols="30" rows="5"><?php echo e($task->description); ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Status">Status</label>
                                                                    <select name="status" id="selected_status" class="form-control form-select">
                                                                        <option value="">Select Status</option>
                                                                        <option value="Pending" <?php echo e($task->status === 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                                                        <option value="On-going" <?php echo e($task->status === 'On-going' ? 'selected' : ''); ?>>On-going</option>
                                                                        <option value="On-Progress" <?php echo e($task->status === 'On-Progress' ? 'selected' : ''); ?>>On-Progress</option>
                                                                        <option value="Started" <?php echo e($task->status === 'Started' ? 'selected' : ''); ?>>Started</option>
                                                                        <option value="Done" <?php echo e($task->status === 'Done' ? 'selected' : ''); ?>>Done</option>
                                                                    </select>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="taskId" value="<?php echo e($task->id); ?>">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Task</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Task Available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewTask" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="addNewTaskLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewTaskLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-text="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('manager.add-task')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="task_name">Task</label>
                            <input type="text" name="task_name" id="task_name"
                                class="<?php $__errorArgs = ['task_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control">
                            <?php $__errorArgs = ['task_name'];
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
                        <div class="form-group">
                            <label for="member_id">Assign To</label>
                            <select name="member_id" id="member_id"
                                class="<?php $__errorArgs = ['member_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control form-select">
                                <option value="">Select Member</option>
                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($member->members->id); ?>"><?php echo e($member->members->fullname); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['member_id'];
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
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="<?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control summernote" name="description"
                                id="description" cols="30" rows="5"></textarea>
                            <?php $__errorArgs = ['description'];
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
                        <div class="form-group">
                            <label for="description">Percentage</label>
                            <input type="range" class="<?php $__errorArgs = ['percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control-range"
                                name="percentage" id="formControlRange" min="1" max="100" value="1">
                            <output id="rangeValue">1%</output>
                            <?php $__errorArgs = ['percentage'];
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
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="projectId" value="<?php echo e($details->id); ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('formControlRange').addEventListener('input', function() {
            document.getElementById('rangeValue').textContent = this.value + '%';
        });
        // $(document).ready(function() {
        //     $('.edit_task').on('click', function() {
        //         var id = $(this).data('id');
        //         console.log(id);
        //         $('#editTask').modal('show');

        //         $.ajax({
        //             url: `/manager/projects/retrieve-task/${id}`,
        //             type: 'GET',
        //             success: function(response) {
        //                 console.log(response)
        //                 $('#task_name_selected').val(response.task_name)
        //                 $('#description_selected').summernote('code', response.description);
        //                 $('#member_name').val(response.taskfor.fullname)
        //                 $('#selected_status').empty().append(`
    //                     <option value="Pending" ${response.status === 'Pending' ? 'selected' : ''}>Pending</option>
    //                     <option value="On-going" ${response.status === 'On-going' ? 'selected' : ''}>On-going</option>
    //                     <option value="On-Progress" ${response.status === 'On-Progress' ? 'selected' : ''}>On-Progress</option>
    //                     <option value="Started" ${response.status === 'Started' ? 'selected' : ''}>Started</option>
    //                     <option value="Done" ${response.status === 'Done' ? 'selected' : ''}>Done</option>
    //                 `);
        //                 $('#taskIdSelected').val(response.id)
        //             },
        //         });
        //     });
        // })
        $('.delete_task').on('click', function() {
            var DataId = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/manager/projects/delete-task/${DataId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if (response.status == 200) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Task has been Removed.",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 1500);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while deleting the task.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.manager.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/manager/projects/view-details.blade.php ENDPATH**/ ?>