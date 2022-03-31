<?php $__env->startSection('title','Edit Company'); ?>
<?php $__env->startSection('page-styles'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/chosen.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/prism.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/style.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/js/imgpicker/imgpicker.css')); ?>">
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
                  <form action="<?php echo e(route('user.update',$user->id)); ?>" class="needs-validation" method="post">
                  <div class="row">
                    <div class="col-md-8">    
                    <?php echo method_field('PATCH'); ?>
                    <?php echo csrf_field(); ?>
                    <fieldset class="form-group">
                      <label for="username">User Name *<small>must be unique contains alphanumeric chars</small></label>
                      <input type="text" class="form-control username <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="username" name="username"  required placeholder="Enter username" value="<?php echo e(old('username',$user->username)); ?>">
                      <div id="username_error" class="text-danger"></div>
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="first_name">User First Name *</label>
                      <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="first_name" name="first_name"  required placeholder="Enter first_name" value="<?php echo e(old('first_name',$user->first_name)); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="last_name">User Last Name *</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" required  placeholder="Enter last_name" value="<?php echo e(old('last_name',$user->last_name)); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="phone_no">Phone no *</label>
                      <input type="text" class="form-control" id="phone_no" name="phone_no" required  placeholder="Enter Phone No" value="<?php echo e(old('phone_no',$user->phone_number)); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="alternate_phone_no">Alternate Phone no <small>(optional)</small></label>
                      <input type="text" class="form-control" id="alternate_phone_no" name="alternate_phone_no"  placeholder="Enter Alternate Phone number" value="<?php echo e(old('alternate_phone_no',$user->alternate_phone_number)); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="internal_data">Internal Data *</label>
                      <input type="text" class="form-control" id="internal_data" name="internal_data" required placeholder="Enter Internal data" value="<?php echo e(old('internal_data',$user->internal_data)); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="vendor">Vendor *</label>
                      <input type="text" class="form-control" id="vendor" name="vendor" required placeholder="Enter Vendor" value="<?php echo e(old('vendor',$user->vendor)); ?>">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="business_type">Business Type *</label>
                      <input type="text" class="form-control" id="business_type" name="business_type" required placeholder="Enter business type" value="<?php echo e(old('business_type',$user->business_type)); ?>">
                    </fieldset>
                  <div class="form-group mb-50">
                    <label class="text-bold-600" for="email">Email address</label>
                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email',$user->email)); ?>" required autocomplete="email" placeholder="Email address">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                      </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-2">
                    <label class="text-bold-600" for="password">Password <small>leave it blank t keep it same</small></label>
                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" autocomplete="new-password" placeholder="Password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-2">
                    <label class="text-bold-600" for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                  </div>
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
                  <div class="col-md-4">
                    <label>Logo</label>
                    <input type="hidden" name="logo" id="image_name" value="" />
                    <div class="image-wrapper" style="height:220px;">
                      <img src="<?php echo e($user->profile_img!='' ? asset('images/avatar/'.$user->profile_img) :asset('images/logo/logo.png')); ?>" class="avatar image1" width="200px" height="200px">
                      <button type="button" class="edit-avatar btn btn-info">Edit</button>
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
</section>
<!-- Basic Inputs end -->


<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/forms/form-tooltip-valid.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/chosen/js/chosen.jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/chosen/js/prism.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/chosen/js/init.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/imgpicker/imgpicker.js')); ?>"></script>
<script type="text/javascript">
$(function() {
  $('#username').keyup(function(e) {
    var txt=$(this).val();
    $.ajax({
      url:"<?php echo e(url('user/check_username')); ?>",
      data:"name="+txt+"&id=<?php echo e($user->id); ?>&_token=<?php echo e(csrf_token()); ?>",
      type:'post',
      dataType:'json',
      beforeSend:function() {
          $('#username_error').html("");
      },
      success:function(res) {
        if(res.error) $('#username_error').html(res.error);
        elsee if(res.success) $('#username_error').html("");
      }
    });
  });
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
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/edit.blade.php ENDPATH**/ ?>