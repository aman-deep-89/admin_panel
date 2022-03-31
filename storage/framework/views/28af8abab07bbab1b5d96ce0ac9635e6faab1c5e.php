<?php $__env->startSection('title','Balance History'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/tables/datatable/datatables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12"><a href="<?php echo e(url('user/add_balance')); ?>" class="btn btn-primary">Add Balance</a></div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Balance History</h4>
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
                                        <th>ID</th> <th>Username</th> <th>Date</th> <th>Amount</th> <th>Description</th><th>Status</th><th>Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                    <tr>  
                                    <td><?php echo e($comp->bh_id); ?></td>  
                                    <td><?php echo e($comp->username); ?><br/><?php echo e($comp->email); ?></td>  
                                    <td><?php echo e($comp->date); ?></td>  
                                    <td>$ <?php echo e($comp->requested_amount); ?></td>  
                                    <td><?php echo e($comp->bh_description); ?></td>  
                                    <td><?php echo e($comp->bh_status); ?>

                                        <?php if($comp->bh_description2): ?>
                                           <br/> (<?php echo e($comp->bh_description2); ?>)
                                        <?php endif; ?>
                                    </td>  
                                    <td>
                                        <?php if($comp->bh_status=='pending'): ?>
                                            
                                        <a href="#" data-id="<?php echo e($comp->bh_id); ?>" data-route="<?php echo e(url('user/accept_request')); ?>" data-amount="<?php echo e($comp->requested_amount); ?>" data-toggle="modal" data-target="#acceptRequest" class="btn btn-sm btn-success accept">Accept</a> <button type="button" class="btn btn-danger btn-sm delete" data-id="<?php echo e($comp->bh_id); ?>" data-route="<?php echo e(url('user/reject_request')); ?>" data-toggle="modal" data-target="#deleteDep">Reject</button></td>  
                                        <?php endif; ?>
                                        <a href="<?php echo e(url('user/open_balance_request/'.$comp->bh_id)); ?>" class="btn btn-sm btn-primary accept">Open</a>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th> <th>Username</th> <th>Date</th> <th>Balance</th> <th>Description</th><th>Status</th> <th>Actions</th>
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
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/balance_requests.blade.php ENDPATH**/ ?>