<footer class="footer footer-light <?php if(isset($configData['footerType'])): ?><?php echo e($configData['footerClass']); ?><?php endif; ?>">
  <p class="clearfix mb-0">
    <span class="float-left d-inline-block"><?php echo e(date('Y')); ?> &copy; All rights reserved</span>
    <span class="float-right d-sm-inline-block d-none">
      <a class="text-uppercase" href="#" target="_blank">Admin Management</a>
    </span>
    <?php if($configData['isScrollTop'] === true): ?>
    <button class="btn btn-primary btn-icon scroll-top" type="button">
      <i class="bx bx-up-arrow-alt"></i>
    </button>
    <?php endif; ?>
  </p>
</footer>
<?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/panels/footer.blade.php ENDPATH**/ ?>