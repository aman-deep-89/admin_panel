<?php $__env->startSection('title','Add Balance'); ?>
<?php $__env->startSection('page-styles'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/chosen.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/prism.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/style.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/js/imgpicker/imgpicker.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/pickers/pickadate/pickadate.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Basic Inputs start -->
<section id="basic-input">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Enter fields</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="row">
                <div class="col-md-12"> 
                    <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="alert alert-danger"><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>  
                <form action="<?php echo e(url('user/add_balance')); ?>" class="needs-validation" method="post">
                <div class="row">
                  <div class="col-md-8">               
                        <?php echo csrf_field(); ?>
                    <fieldset class="form-group">
                      <label for="first_name">User</label>
                      <?php echo Form::select('user_id', $users, 0, ['class' => 'form-control required chosen-select']); ?>

                    </fieldset>
                    <fieldset class="form-group">
                      <label for="balance_amount">Balance Amount</label>
                      <input type="number" min="1" step="0.01" class="form-control" id="balance_amount" name="balance_amount" required  placeholder="Enter Amount" value="<?php echo e(old('balance_amount')); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="date">Date</label>
                      <input type="text" class="form-control" id="date" name="date" required  placeholder="Enter Date" value="<?php echo e(old('date')); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="description">Description <small>optional</small></label>
                      <textarea class="form-control" id="description" name="description" required  placeholder="Enter description"><?php echo e(old('description')); ?></textarea>
                    </fieldset>
                    <button class="btn btn-primary" type="submit">Save</button>
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
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/forms/form-tooltip-valid.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/chosen/js/chosen.jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/chosen/js/prism.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/chosen/js/init.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/imgpicker/imgpicker.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
<script type="text/javascript">
$(function() {  
  $('.edit-avatar').imgPicker({
    el: '.avatar',
    type: 'avatar',  
    width:500,  
    minWidth: 100,
    minHeight: 100,
    title: 'Change your Logo',
    aspectRatio:'3:2',
    dataEl : 'image_name',
    _token: "<?php echo e(csrf_token()); ?>",
	  api: '<?php echo e(url('upload_image')); ?>',
	});
	 $('.ip-save').click( function(){   
            net();
    });
    $('#date').pickadate({
        format:'dd/mm/yyyy'
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/add_balance.blade.php ENDPATH**/ ?>