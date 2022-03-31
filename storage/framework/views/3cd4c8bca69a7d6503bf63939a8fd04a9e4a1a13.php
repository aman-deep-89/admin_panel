<!DOCTYPE html>

<?php if(isset($pageConfigs)): ?>
  <?php echo Helper::updatePageConfig($pageConfigs); ?>

<?php endif; ?>
<?php
// confiData variable layoutClasses array in Helper.php file.
  $configData = Helper::applClasses();
?>

<html class="loading" lang="<?php if(session()->has('locale')): ?><?php echo e(session()->get('locale')); ?><?php else: ?><?php echo e($configData['defaultLanguage']); ?><?php endif; ?>"
 data-textdirection="<?php echo e($configData['direction'] == 'rtl' ? 'rtl' : 'ltr'); ?>">
  <!-- BEGIN: Head-->

    <head>
    <meta  charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?> <?php echo e(getenv('app_name')); ?></title>
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/ico/apple-icon-120.png')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('images/ico/favicon.ico')); ?>">

    
    <?php echo $__env->make('panels.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('page-styles'); ?>
    </head>
    <!-- END: Head-->

     <?php if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType'])): ?>
     <?php echo $__env->make(($configData['mainLayoutType'] === 'horizontal-menu') ? 'layouts.horizontalLayoutMaster':'layouts.verticalLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php else: ?>
     
     <h1><?php echo e('mainLayoutType Option is empty in config custom.php file.'); ?></h1>
     <?php endif; ?>

</html>
<?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/layouts/contentLayoutMaster.blade.php ENDPATH**/ ?>