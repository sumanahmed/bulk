<?php $__env->startSection('content'); ?>
    <div class="container-fluid app-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row filter-section">
                    <form action="<?php echo e(route('post_filter')); ?>" method="post" id="postingForm">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-md-3">
                            <div class="activities">
                                <input class="form-control" type="search" name="search" placeholder="search" id="search"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="activities">
                                <input type="date" class="form-control" name="date" id="Date" <?php if(isset($date)): ?> value="<?php echo e(date("F J, Y", strtotime($date))); ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="activities">
                                <select class="form-control" name="group_id" id="group_id">
                                    <option selected disabled>All Group</option>
                                    <?php $__currentLoopData = $post_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($post_group->id); ?>" <?php if(isset($group_id) && $group_id == $post_group->id): ?> selected <?php endif; ?>><?php echo e($post_group->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="activities">
                                <input class="btn btn-primary" type="submit" name="submit" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 group-col">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Recent Post sent to buffer</h3>
                        <div class="activities">

                            <div class="panel panel-default activity">
                                <div class="panel-body">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th width="15%">Group Name</th>
                                                <th width="15%">Group Type</th>
                                                <th width="15%">Account Name</th>
                                                <th width="45%">Post Text</th>
                                                <th width="10%">Time</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $postings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($posting->group_name); ?></td>
                                                    <td><?php echo e($posting->group_type); ?></td>
                                                    <td class="text-center"><img class="avatar-img" src="<?php echo e(asset($posting->account_name)); ?>"></td>
                                                    <td><?php echo e($posting->post_text); ?></td>
                                                    <td class="text-center"><?php echo e($posting->time); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                    <?php echo e($postings->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>