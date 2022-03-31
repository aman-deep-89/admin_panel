<?php $__env->startSection('title','Open Account Requests'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/pickers/pickadate/pickadate.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Requests Detail</h4>
                </div>
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
                        <form action="" method="post" class="needs-validation" id="save_account">
                            <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-3"> User name </div>
                            <div class="col-3"> <?php echo e($detail->users->username); ?> (<?php echo e($detail->users->email); ?>) </div>
                            <div class="col-3"> Product </div>
                            <div class="col-3"> <?php echo e($detail->products->name); ?> </div>
                            <div class="col-3"> Total Accounts </div>
                            <div class="col-3"> <?php echo e($detail->quantity); ?> </div>
                            <div class="col-3"> Price </div>
                            <div class="col-3"> <?php echo e($detail->total_price); ?> </div>
                        </div>
                            <div class="mt-1 pt-2 border-top">
                                <div class="row d-flex">
                                    <div class="col-md-2"><strong>Email/Username</strong></div>
                                    <div class="col-md-2"><strong>Password</strong></div>
                                    <div class="col-md-3"><strong>Start Date</strong></div>
                                    <div class="col-md-3"><strong>End Date</strong></div>
                                    <div class="col-md-2"><strong>Days Remaining/Cost</strong></div>                                    
                                </div>
                                    <?php $__currentLoopData = $detail->purchase_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                   
                                        <div class="row d-flex mt-1">
                                            <div class="col-md-2"><?php echo e($item->pd_username); ?></div>
                                            <div class="col-md-2"><?php echo e($item->pd_password); ?></div>
                                            <div class="col-md-3"><?php echo e($item->pd_start_date); ?></div>
                                            <div class="col-md-3"><?php echo e($item->pd_end_date); ?></div>
                                            <div class="col-md-2"><?php echo e($item->pd_status); ?></div>
                                        </div> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="row mt-3">
                                <div class="col-12 text-center text-danger" id="error"></div>
                                <div class="col-12 text-center">
                                    <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                    <a href="<?php echo e(url('view_purchases')); ?>" name="btn" class="btn btn-secondary">Back</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/forms/form-tooltip-valid.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/daterange/moment.min.js')); ?>"></script>
    <script tyle="text/javascript">    
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/frontend/open_purchase_account.blade.php ENDPATH**/ ?>