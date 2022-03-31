<?php $__env->startSection('title','Product List'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/tables/datatable/datatables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12"><a href="<?php echo e(route('product.create')); ?>" class="btn btn-primary">Add New Product</a></div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product List</h4>
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                    <tr>  
                                    <td><?php echo e($comp->id); ?></td>  
                                    <td><?php echo e($comp->name); ?></td>  
                                    <td><?php echo e($comp->sku); ?></td>  
                                    <td><?php echo e($comp->price); ?></td>  
                                    <td><?php echo e($comp->closing_stock); ?></td>  
                                    <td><?php echo $comp->out_of_stock ? '<span class="badge badge-danger">Out of Stock' : '<span class="badge badge-success">In Stock' ?></td>  
                                    <td><a href="<?php echo e(url('product/view_accounts', $comp->id)); ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?php echo e(route('product.edit', $comp->id)); ?>" class="btn btn-sm btn-primary">Edit</a> <button type="button" class="btn btn-danger btn-sm delete" data-id="<?php echo e($comp->id); ?>" data-name="<?php echo e($comp->name); ?>" data-route="<?php echo e(route('product.destroy', $comp->id)); ?>" data-toggle="modal" data-target="#deleteDep">Delete</button></td>  
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Description</th>
                                        <th>Actions</th>
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
<div class="modal fade" id="deleteDep" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteDepartment" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
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
                    Are you sure you want to delete <span id="pname"></span>?
                    <input type="hidden" id="product" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
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
        $('#deleteDep').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var product = button.data('id');
            var product_name = button.data('name');
            var action = button.data('route');
            $('#delete_form').attr("action",action);
            var modal = $(this);
            modal.find('.modal-body #product').val(product);
            modal.find('.modal-body #pname').val(product_name);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/product/index.blade.php ENDPATH**/ ?>