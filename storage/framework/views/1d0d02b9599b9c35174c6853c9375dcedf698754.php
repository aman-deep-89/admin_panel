<?php $__env->startSection('title','Edit Company'); ?>
<?php $__env->startSection('page-styles'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/chosen.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/prism.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/scripts/chosen/css/style.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/js/imgpicker/imgpicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Basic Inputs start -->
<section class="invoice-view-wrapper">
    <div class="row">
      <!-- invoice view page -->
      <div class="col-xl-9 col-md-8 col-12">
        <div class="card invoice-print-area">
          <div class="card-content">
            <div class="card-body pb-0 mx-25">             
              <!-- logo and title -->
              <div class="row my-3">
                <div class="col-6">
                  <h4 class="text-primary"><?php echo e($product->name); ?></h4>
                  <span><?php echo e($product->description); ?></span>
                </div>
                <div class="col-6 d-flex justify-content-end">
                  SKU: <?php echo e($product->sku); ?>

                </div>
              </div>
              <hr>
              <!-- invoice address and contact -->
              <div class="row invoice-info">
                <div class="col-12 mt-1">
                  <h6 class="invoice-to">Assets</h6>
                  <div id="carousel-<?php echo e($product->id); ?>" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                    <?php if($product->photos) { 
                        $images=json_decode($product->photos,true);
                        ?>
                    <ol class="carousel-indicators">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-target="#carousel-<?php echo e($product->id); ?>" data-slide-to="<?php echo e($key); ?>" class="<?php if($key==0) echo 'active' ?>"></li>      
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php if($key==0) echo 'active' ?>">
                                <img class="img-fluid" src="<?php echo e(getenv('app_url').Storage::url('app/public/'.$img)); ?>" alt="<?= $img ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                              
                    </div>
                    <a class="carousel-control-prev" href="#carousel-<?php echo e($product->id); ?>" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-<?php echo e($product->id); ?>" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                    <?php } ?>
                  </div>            
                </div>
              </div>
              <hr>
            </div>
           
  
            <!-- invoice subtotal -->
            <div class="card-body pt-0 mx-25">
              <hr>
              <div class="row">
                <div class="col-4 col-sm-6 mt-75">
                  <p>Thanks for your business.</p>
                </div>
                <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                  <div class="invoice-subtotal">
                    <div class="invoice-calc d-flex justify-content-between">
                      <span class="invoice-title">Invoice Total</span>
                      <span class="invoice-value"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($product->price); ?></span>
                    </div>
                    <div class="invoice-calc d-flex justify-content-between">
                      <span class="invoice-title">Available Balance</span>
                      <?php $balance=Auth::user()->current_balance; ?>
                      <span class="invoice-value <?php if($balance<$product->price) echo 'text-danger' ?>">- <?php echo e(getenv('CURRENCY')); ?> <?php echo e($balance); ?></span>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- invoice action  -->
      <div class="col-xl-3 col-md-4 col-12">
        <div class="card invoice-action-wrapper shadow-none border">
          <div class="card-body">
            <?php if($balance>=$product->price): ?> 
            <div class="invoice-action-btn">
              <button class="btn btn-primary btn-block invoice-send-btn">
                <i class="bx bx-send"></i>
                <span>Confirm Purchase</span>
              </button>
            </div>
            <?php else: ?> 
                <div class="invoice-action-btn mt-1">
                    <div class="text-danger">You don't have sufficient balance to complete this transaction. Kindly contact admin to add/update your balance</div>
                </div>
            <?php endif; ?>
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

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/frontend/product_detail.blade.php ENDPATH**/ ?>