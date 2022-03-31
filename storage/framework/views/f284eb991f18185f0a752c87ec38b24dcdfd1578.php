<?php $__env->startSection('title','Modify Purchase Detail'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Modify Purchase Detail</h4>
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
                            <div class="alert alert-warning">You can't edit this information</div>
                    </div>
                </div>
            </div>
        </div>
         </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/no_record.blade.php ENDPATH**/ ?>