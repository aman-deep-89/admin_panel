
    <!-- BEGIN: Vendor JS-->
    <script>
        var assetBaseUrl = "<?php echo e(asset('')); ?>";
    </script>
    <script src="<?php echo e(asset('vendors/js/vendors.min.js')); ?>"></script>
    <script src="<?php echo e(asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.js')); ?>"></script>
    <script src="<?php echo e(asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')); ?>"></script>
    <script src="<?php echo e(asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js')); ?>"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <?php echo $__env->yieldContent('vendor-scripts'); ?>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <?php if($configData['mainLayoutType'] == 'vertical-menu'): ?>
    <script src="<?php echo e(asset('js/scripts/configs/vertical-menu-light.js')); ?>"></script>
    <?php else: ?>
    <script src="<?php echo e(asset('js/scripts/configs/horizontal-menu.js')); ?>"></script>
    <?php endif; ?>
    <script src="<?php echo e(asset('js/core/app-menu.js')); ?>"></script>
    <script src="<?php echo e(asset('js/core/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scripts/components.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scripts/footer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scripts/customizer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/js/extensions/toastr.min.js')); ?>"></script>    
    <script type="text/javascript">
        $(function() {
            <?php if(auth()->check() && auth()->user()->hasRole('user')): ?>
            setInterval(function () {
                $.ajax({
                    url:'<?php echo e(url('check_notification')); ?>',
                    data:'_token=<?php echo e(csrf_token()); ?>',
                    type:'post',
                    dataType:'json',
                    success:function(res) {
                        if(res.success) {
                            $.each(res.notifications,function(index,item) {
                                if(item.pd_updated==1) 
                                    toastr.success('Your request has been updated','Status Update for '+item.name, { "closeButton": true, positionClass: 'toast-bottom-right',"timeOut": 0  });
                                else if(item.pd_status=='accepted')
                                    toastr.success('Your request has been '+item.pd_status+' for 1 account','Status Update for '+item.name, { "closeButton": true, positionClass: 'toast-bottom-right',"timeOut": 0  });
                                else 
                                    toastr.error('Your request has been '+item.pd_status+' for 1 account','Status Update for '+item.name, { "closeButton": true, positionClass: 'toast-bottom-right',"timeOut": 0  });
                            });
                        }
                    }
                });
            },60000);
            <?php endif; ?>
        });
    </script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <?php echo $__env->yieldContent('page-scripts'); ?>
    <!-- END: Page JS-->
<?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/panels/scripts.blade.php ENDPATH**/ ?>