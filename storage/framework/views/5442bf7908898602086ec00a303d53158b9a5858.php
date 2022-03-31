<?php $__env->startSection('title','Modify Purchase Detail'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/pickers/pickadate/pickadate.css')); ?>">
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
                        <form action="<?php echo e(url('purchase/update_purchase_request')); ?>" method="post" class="needs-validation" id="save_account">
                            <?php echo csrf_field(); ?>
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
                            <div class="table-responsive">
                                <div class="card invoice-print-area">
                                    <div class="card-content">
                                      <div class="card-body pb-0 mx-25">             
                                        <!-- logo and title -->
                                        <div class="row">
                                          <div class="col-6">
                                            <h4 class="text-primary"><?php echo e($detail->purchases->users->username); ?></h4>
                                            <span><?php echo e($detail->purchases->users->email); ?></span><br/>
                                            <span>Date <?php echo e(date('d-m-Y h:i A',strtotime($detail->pd_creation_date))); ?></span><br/>
                                          </div>                                         
                                        </div>                                       
                                      </div>
                                    </div>
                                  </div>                                  
                        </div>
                        <div class="row d-flex">
                            <div class="col-md-2"><strong>Email/Username</strong></div>
                            <div class="col-md-2"><strong>Password</strong></div>
                            <div class="col-md-3"><strong>Start Date</strong></div>
                            <div class="col-md-3"><strong>End Date</strong></div>
                            <div class="col-md-2"><strong>Days Remaining</strong></div>                                    
                        </div>
                        <div class="row d-flex">
                            <input type="hidden" name="pd_id" value="<?php echo e($detail->pd_id); ?>" >
                            <div class="col-md-2"><input type="text" required class="form-control" name="username" placeholder="Username" value="<?php echo e($detail->pd_username); ?>"/></div>
                            <div class="col-md-2"><strong><input type="text" required class="form-control" name="password" placeholder="password" value="<?php echo e($detail->pd_password); ?>"/></strong></div>
                            <div class="col-md-3"><strong><input type="text" required class="form-control spickadate" id="start_date" name="start_date" placeholder="start_date" value="<?php echo e(date('d/m/Y',strtotime($detail->pd_start_date))); ?>"/></strong></div>
                            <div class="col-md-3"><strong><input type="text" required class="form-control epickadate" id="end_date" name="end_date" placeholder="end_date" value="<?php echo e(date('d/m/Y',strtotime($detail->pd_end_date))); ?>"/></strong></div>
                            <div class="col-md-2"><span id="remaining_days"><?php echo e($detail->diff); ?></span></div>                                    
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center text-danger" id="error"></div>
                            <div class="col-12 text-center">
                                <button type="submit" name="btn" class="btn btn-primary">Save</button>
                                <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                <a href="<?php echo e(url('user/purchase_requests')); ?>" name="btn" class="btn btn-secondary">Back</a>
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
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/daterange/moment.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script tyle="text/javascript">
        $(function() {
            $('.spickadate').pickadate({
            format:'dd/mm/yyyy',
            onSet: function(context) {
               
            }
        });
        $('.epickadate').pickadate({
            format:'dd/mm/yyyy'
        });
        $('.spickadate').change(function() {
            var v=$(this).val();            
            $('#end_date').val('')
            $('#end_date').pickadate('picker').set('min',$(this).val());
        });
        $('.epickadate').change(function() {
            var v=$(this).val(); 
            var v2='<?= date('d/m/Y') ?>';
            var a = moment(v2,'D/M/YYYY');
            var b = moment(v,'D/M/YYYY');
            console.log(a+"="+b)
            var diffDays = b.diff(a, 'days');
            $('#remaining_days').text(diffDays);
        });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/modify_purchase_detail.blade.php ENDPATH**/ ?>