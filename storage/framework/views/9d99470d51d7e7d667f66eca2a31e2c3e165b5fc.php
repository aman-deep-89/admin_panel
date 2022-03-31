<?php $__env->startSection('title','Notifications'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/widgets.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php if($message = Session::get('success')): ?>
                            <div class="alert alert-success">
                                <p><?php echo e($message); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if($message = Session::get('error')): ?>
                            <div class="alert alert-danger">
                                <p><?php echo e($message); ?></p>
                            </div>
                        <?php endif; ?>
                            <div class="">
                                    <div class="col-12">
                                        <div class="card widget-todo">
                                          <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                            <h4 class="card-title d-flex">
                                              <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Notifications
                                            </h4>
                                          </div>
                                          <div class="card-body px-0 py-1">
                                            <ul class="widget-todo-list-wrapper" id="widget-todo-list">
                                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                                    <li class="widget-todo-item">
                                                        <div class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                                        <div class="widget-todo-title-area d-flex align-items-center">
                                                            <span class="widget-todo-title ml-0"><strong><?php echo e($comp->notification_title); ?></strong></span>
                                                        </div>
                                                        <div class="widget-todo-item-action d-flex align-items-center">
                                                            <div class="badge badge-pill badge-light-success mr-1"><?php echo e($comp->created_at); ?></div>
                                                            <div class="avatar bg-rgba-primary m-0 mr-50">
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <p><p><?php echo e($comp->notification_text); ?></p>
                                                    </li>
                                                    <hr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-scripts'); ?>
<script src="<?php echo e(asset('vendors/js/tables/datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/datatables/datatable.js')); ?>"></script>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/frontend/notifications.blade.php ENDPATH**/ ?>