<?php $__env->startSection('title','Balance Request Details'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/tables/datatable/datatables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Balance Request Details</h4>
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
                            <div class="table-responsive">
                                <div class="card invoice-print-area">
                                    <div class="card-content">
                                      <div class="card-body pb-0 mx-25">             
                                        <!-- logo and title -->
                                        <div class="row my-3">
                                          <div class="col-6">
                                            <h4 class="text-primary"><?php echo e($list->username); ?></h4>
                                            <span><?php echo e($list->email); ?></span><br/>
                                            <span>Date <?php echo e(date('d-m-Y h:i A',strtotime($list->bh_created_at))); ?></span><br/>
                                          </div>
                                          <div class="col-6 d-flex justify-content-end">
                                            Requested Amount: <?php echo e(getenv('CURRENCY')); ?> <?php echo e($list->requested_amount); ?><br/>
                                            Approved Amount: <?php echo e(getenv('CURRENCY')); ?> <?php echo e($list->amount); ?><br/>
                                          </div>
                                        </div>
                                        <hr>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                          <div class="col-12 mt-1">
                                            <h6 class="invoice-to">Assets</h6>
                                            <div id="carousel-<?php echo e($list->bh_id); ?>" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                                              <?php if($list->bh_images) { 
                                                  $images=json_decode($list->bh_images,true);
                                                  ?>
                                              <ol class="carousel-indicators">
                                                  <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <li data-target="#carousel-<?php echo e($list->bh_id); ?>" data-slide-to="<?php echo e($key); ?>" class="<?php if($key==0) echo 'active' ?>"></li>      
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </ol>
                                              <div class="carousel-inner" role="listbox">
                                                  <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <div class="carousel-item <?php if($key==0) echo 'active' ?>">
                                                          <img class="img-fluid" src="<?php echo e(getenv('app_url').Storage::url('app/public/'.$img)); ?>" alt="<?= $img ?>">
                                                      </div>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                              
                                              </div>
                                              <a class="carousel-control-prev" href="#carousel-<?php echo e($list->bh_id); ?>" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                              </a>
                                              <a class="carousel-control-next" href="#carousel-<?php echo e($list->bh_id); ?>" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                              </a>
                                              <?php } ?>
                                            </div>            
                                          </div>
                                        </div>
                                        <hr>
                                      </div>
                                    </div>
                                  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-12">
            <div class="card invoice-action-wrapper shadow-none border">
                <?php if($list->bh_status=='pending'): ?> 
              <div class="card-body">
               <div class="invoice-action-btn">
                  <button class="btn btn-success btn-block invoice-send-btn accept" data-id="<?php echo e($list->bh_id); ?>" data-route="<?php echo e(url('user/accept_request')); ?>" data-amount="<?php echo e($list->requested_amount); ?>" data-toggle="modal" data-target="#acceptRequest">
                    <i class="bx bx-check"></i>
                    <span>Accept</span>
                  </button>
                </div>  
               <div class="invoice-action-btn mt-1">
                  <button class="btn btn-danger btn-block invoice-send-btn delete" data-id="<?php echo e($list->bh_id); ?>" data-route="<?php echo e(url('user/reject_request')); ?>" data-toggle="modal" data-target="#deleteDep">
                    <i class="bx bx-trash"></i>
                    <span>Reject</span>
                  </button>
                </div>
            </div>
            <?php endif; ?>
            <div class="invoice-action-btn mt-1">
               <a class="btn btn-secondary btn-block invoice-send-btn delete" href="<?php echo e(url('user/balance_requests')); ?>">
                 <i class="bx bx-undo"></i>
                 <span>Back</span>
               </a>
             </div>
            </div>
          </div>
    </div>
</section>
<!-- accept form-->
<div class="modal fade" id="acceptRequest" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="acceptRequest" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="accept_form">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accept Request</h5>                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to accept this request?
                    <input type="number" step="0.01" class="form-control" name="amount" id="amount"/>
                    <div class="form-group mt-1">
                        <textarea name="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <input type="hidden" id="request_id2" name="request_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Accept</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- delete form-->
<div class="modal fade" id="deleteDep" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteDepartment" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="delete_form">
            <?php echo method_field('DELETE'); ?>
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to reject this request?
                    <div class="form-group mt-1">
                        <textarea name="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <input type="hidden" id="request_id" name="request_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-scripts'); ?>
<script src="<?php echo e(asset('vendors/js/tables/datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/datatables/datatable.js')); ?>"></script>
    <script tyle="text/javascript">
        $('#acceptRequest').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var request_id = button.data('id');
            var amount = button.data('amount');
            var action = button.data('route');
            $('#accept_form').attr("action",action);
            var modal = $(this);
            modal.find('.modal-body #request_id2').val(request_id);
            modal.find('.modal-body #amount').val(amount);
        });
        $('#deleteDep').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var request_id = button.data('id');
            var action = button.data('route');
            $('#delete_form').attr("action",action);
            var modal = $(this);
            modal.find('.modal-body #request_id').val(request_id);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/balance_request_detail.blade.php ENDPATH**/ ?>