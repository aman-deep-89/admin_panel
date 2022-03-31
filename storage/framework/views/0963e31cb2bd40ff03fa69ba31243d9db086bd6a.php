<?php $__env->startSection('title','Users List'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/tables/datatable/datatables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12"><a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary">Add New User</a></div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users</h4>
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
                                        <th>Username</th> <th>Email</th><th>Role</th><th>Balance</th> <th>Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php //print_r($user); exit; ?>
                                    <tr>  
                                    <td><?php echo e($user->id); ?></td>  
                                    <td>
                                        <div class="d-flex align-items-center text-bold-500">
                                            <img class="rounded-circle mr-1" src="<?php echo e($user->profile_img!='' ? asset('images/avatar/'.$user->profile_img) :asset('images/logo/logo.png')); ?>" alt="avatar" height="32" width="32">
                                        <div class="flex-content"><?php echo e($user->username); ?></div>
                                    </div>
                                    </td>  
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php foreach($user->user_roles as $role) {
                                        echo $role->name;
                                    } ?></td>
                                    <td><?php echo e($user->current_balance); ?></td>
                                    <td><a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-primary btn-sm">Edit</a> 
                                    <?php if($user->id!=Auth::user()->id): ?>
                                        <button type="button" class="btn btn-danger btn-sm delete" data-id="<?php echo e($user->id); ?>" data-route="<?php echo e(route('user.destroy', $user->id)); ?>" data-toggle="modal" data-target="#deleteDep">Delete</button>
                                    <?php endif; ?>
                                    </td>  
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th> <th>UserName</th> <th>Email</th> <th>Role</th><th>Balance</th> <th>Actions</th>
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
    <div class="modal-dialog modal-md" role="document">
        <form action="#" method="post" id="delete_form">
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
                    Are you sure you want to delete this user and all of his transactions?
                    <input type="hidden" id="role" name="role_id">
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
            var role = button.data('id'); 
            var action = button.data('route');
            var modal = $(this);
            $('#delete_form').attr("action",action);
            modal.find('.modal-body #role').val(role);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views//users/index.blade.php ENDPATH**/ ?>