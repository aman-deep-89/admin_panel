<?php $__env->startSection('title','Purchase Requests'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/tables/datatable/datatables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase Requests</h4>
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
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>User<th>Product</th><th>Date</th><th>Price</th><th>Quantity</th><th>Status</th><th>Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                    <tr>  
                                    <td><?php echo e($comp->purchase_id); ?></td>  
                                    <td><?php echo e($comp->users->username); ?></td>  
                                    <td><?php echo e($comp->products->name); ?></td>  
                                    <td><?php echo e($comp->p_creation_date); ?></td>  
                                    <td><?php echo e(getenv('CURRENCY')); ?> <?php echo e($comp->total_price); ?></td>  
                                    <td><?php echo e($comp->quantity); ?></td>  
                                    <td><?php $__currentLoopData = $comp->purchase_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($item->pd_status); ?> <br/>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('user/open_request/'.$comp->purchase_id)); ?>" class="btn btn-sm btn-primary">Open</a>
                                    </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th><th>User<th>Product</th><th>Date</th><th>Price</th><th>Quantity</th><th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/purchase_requests.blade.php ENDPATH**/ ?>