<?php $__env->startSection('title','Open Issue Detail'); ?>


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
                    <h4 class="card-title">Issue Detail</h4>
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
                        <div class="row">
                            <div class="col-3"> User name </div>
                            <div class="col-3"> <?php echo e($detail->purchase_detail->purchases->users->username); ?> (<?php echo e($detail->purchase_detail->purchases->users->email); ?>) </div>
                            <div class="col-3"> Product </div>
                            <div class="col-3"> <?php echo e($detail->purchase_detail->purchases->products->name); ?> </div>
                            <div class="col-3"> Total Accounts </div>
                            <div class="col-3"> <?php echo e($detail->purchase_detail->pd_quantity); ?> </div>
                            <div class="col-3"> Price </div>
                            <div class="col-3"> <?php echo e($detail->purchase_detail->pd_price); ?> </div>
                        </div>
                            <div class="mt-1 pt-2 border-top">
                                <div class="row d-flex">
                                    <div class="col-md-2"><strong>Email/Username-Password</strong></div>
                                    <div class="col-md-3"><strong>Start Date/End Date</strong></div>
                                    <div class="col-md-2"><strong>Status</strong></div>
                                    <div class="col-md-2"><strong>Issue Reported</strong></div>
                                    <div class="col-md-2"><strong>Issue Status</strong></div>
                                </div>
                                    <div class="row d-flex mt-1">
                                            <div class="col-md-2"><?php echo e($detail->purchase_detail->pd_username); ?>-<?php echo e($detail->purchase_detail->pd_password); ?></div>
                                            <div class="col-md-3"><?php echo e($detail->purchase_detail->pd_start_date); ?> to <?php echo e($detail->purchase_detail->pd_end_date); ?></div>
                                            <div class="col-md-2"><?php echo e($detail->purchase_detail->pd_status); ?></div>
                                            <div class="col-md-2"><?php echo e($detail->detail); ?> On <br/> <?php echo e($detail->created_at->format('d-m-Y h:i A')); ?></div>
                                            <div class="col-md-2"><?php echo e($detail->issue_status); ?> <br/> <?php echo e($detail->status_description); ?></div>
                                        </div>
                        </div>
                        <?php if(auth()->user()->hasRole('admin') && $detail->issue_status=='pending'): ?> 
                        <form action="<?php echo e(url('update_issue_status')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="issue_id" value="<?php echo e($detail->id); ?>" />
                            <div class="row">
                                <div class="col-6">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Enter Description</label>
                                <textarea class="form-control" name="description" value="<?php echo e(old('decsription')); ?>"></textarea>
                            </div>
                            </div>
                        
                        <div class="row mt-3">                           
                            <div class="col-12 text-center text-danger" id="error"></div>
                            <div class="col-12 text-center"> 
                            <?php if($detail->issue_status=='pending'): ?> 
                                <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif; ?>
                                <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                <a href="<?php echo e(url('view_issues')); ?>" name="btn" class="btn btn-secondary">Back</a>
                            </div>
                    </div>
                </form>
                        <?php else: ?>                                                
                        <div class="row mt-3">                           
                                <div class="col-12 text-center text-danger" id="error"></div>
                                <div class="col-12 text-center"> 
                                    <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                    <a href="<?php echo e(url('view_issues')); ?>" name="btn" class="btn btn-secondary">Back</a>
                                </div>
                        </div>
                        <?php endif; ?>
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
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/open_issue.blade.php ENDPATH**/ ?>