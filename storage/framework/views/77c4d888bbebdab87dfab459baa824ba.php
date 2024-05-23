<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Tasks</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php $__currentLoopData = $projectDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                    unset($trans["\""], $trans['<'], $trans['>'], $trans['<h2']);
                    $desc = strtr(html_entity_decode($tasksMounted->description), $trans);
                    $desc = str_replace(['<li>', '</li>', '&nbsp;'], ['', ', ', ' '], $desc);
                ?>
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h4>Update <?php echo e($tasksMounted->task_name); ?> ( <?php echo e($project->project_name); ?> )</h4>
                        </div>
                        <div class="card-body">


                            <form id="validation" method="POST" action="<?php echo e(route('member.add-productivity')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="task_id" value="<?php echo e($tasksMounted->id); ?>">
                                <input type="hidden" name="projectId" value="<?php echo e($project->id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Task Description</label>
                                        <p class="border-bottom"><?php echo e(strip_tags($desc)); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Task Percentage</label>
                                        <p class="border-bottom"><?php echo e($tasksMounted->percentage); ?> %</p>
                                    </div>
                                </div>
                                <hr>
                                <h4>Submit Productivity</h4>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Added Date</label>
                                        <input type="date" name="added_date" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Start Time</label>
                                        <input type="time" name="start_time" id="start_time"
                                            class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>End Time</label>
                                        <input type="time" name="end_time" id="end_time" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Rendered Time</label>
                                        <input readonly type="text" name="time_rendered" id="time_rendered"
                                            class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Update Task Status</label>
                                        <select name="status" class="form-select form-control validate">
                                            <option value="">Select</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>


    <script>
       $(document).ready(function() {
    $('#start_time, #end_time').on('change', function() {
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();

        if (startTime && endTime) {
            var start = new Date('1970-01-01T' + startTime + ':00');
            var end = new Date('1970-01-01T' + endTime + ':00');

            var diff = end - start; // Difference in milliseconds

            // Convert difference to hours
            var hours = diff / (1000 * 60 * 60);

            // Round off to two decimal places
            hours = Math.round(hours * 100) / 100;

            // Update the "Rendered Time" input with total hours
            $('#time_rendered').val(hours);
        } else {
            $('#time_rendered').val('');
        }
    });
});

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.member.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/member/projects/task-mounted.blade.php ENDPATH**/ ?>