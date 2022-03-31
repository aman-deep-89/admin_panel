<?php $__env->startSection('title','Open Account Requests'); ?>


<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/pickers/pickadate/pickadate.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Requests Detail</h4>
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
                        <form action="" method="post" class="needs-validation" id="save_account">
                            <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-3"> User name </div>
                            <div class="col-3"> <?php echo e($detail->users->username); ?> (<?php echo e($detail->users->email); ?>) </div>
                            <div class="col-3"> Product </div>
                            <div class="col-3"> <?php echo e($detail->products->name); ?> </div>
                            <div class="col-3"> Total Accounts </div>
                            <div class="col-3"> <?php echo e($detail->quantity); ?> </div>
                            <div class="col-3"> Price </div>
                            <div class="col-3"> <?php echo e($detail->total_price); ?> </div>
                        </div>
                            <div class="mt-1 pt-2 border-top">
                                <div class="row d-flex">
                                    <div class="col-md-2"><strong>Email/Username</strong></div>
                                    <div class="col-md-2"><strong>Password</strong></div>
                                    <div class="col-md-3"><strong>Start Date</strong></div>
                                    <div class="col-md-3"><strong>End Date</strong></div>
                                    <div class="col-md-2"><strong>Days Remaining/Cost</strong></div>                                    
                                </div>
                                <?php $flag=false; ?>
                                    <?php $__currentLoopData = $detail->purchase_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->pd_status=='pending'): ?>  
                                    <?php $flag=true ?>
                                    <div class="row d-flex mt-1" id="row<?php echo e($key); ?>">
                                        <input type="hidden" required name="detail[<?php echo e($key); ?>][pd_id]" value="<?php echo e($item->pd_id); ?>" />
                                        <div class="col-md-2"><input type="text" required class="form-control" name="detail[<?php echo e($key); ?>][username]" placeholder="Username"/></div>
                                        <div class="col-md-2"><input type="text" required class="form-control" name="detail[<?php echo e($key); ?>][password]" placeholder="Password" /></div>  
                                        <div class="col-sm-12 col-md-3">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control spickadate" required data-id="<?php echo e($key); ?>" id="start_date<?php echo e($key); ?>" name="detail[<?php echo e($key); ?>][start_date]" placeholder="Select Start Date">
                                                <div class="form-control-position">
                                                  <i class='bx bx-calendar'></i>
                                                </div>
                                              </fieldset>
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control epickadate" required data-id="<?php echo e($key); ?>" id="end_date<?php echo e($key); ?>"  name="detail[<?php echo e($key); ?>][end_date]" placeholder="Select End Date">
                                                <div class="form-control-position">
                                                  <i class='bx bx-calendar'></i>
                                                </div>
                                              </fieldset>
                                        </div>
                                        <div class="col-md-2"><span id="remaining_days<?php echo e($key); ?>"></span>
                                            <input type="number" step="0.01" class="form-control" required id="cost<?php echo e($key); ?>"  name="detail[<?php echo e($key); ?>][cost]" placeholder="Enter Cost">
                                            <select class="form-control accept" data-id="<?php echo e($key); ?>" id="accept<?php echo e($key); ?>" name="detail[<?php echo e($key); ?>][status]">
                                                <option value="accept">Accept</option>
                                                <option value="reject">Reject</option>
                                                <option value="nothing">Do Nothing</option>
                                            </select>  
                                        </div>                                      
                                    </div>
                                    <?php else: ?>
                                        <div class="row d-flex mt-1">
                                            <div class="col-md-2"><?php echo e($item->pd_username); ?></div>
                                            <div class="col-md-2"><?php echo e($item->pd_password); ?></div>
                                            <div class="col-md-3"><?php echo e($item->pd_start_date); ?></div>
                                            <div class="col-md-3"><?php echo e($item->pd_end_date); ?></div>
                                            <div class="col-md-2"><?php echo e($item->pd_status); ?></div>
                                        </div> 
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="row">
                                <div class="col-12 text-center text-danger" id="error"></div>
                                <div class="col-12 text-center">
                                    <?php if($flag): ?> 
                                        <button type="submit" name="btn" class="btn btn-primary">Save</button>
                                    <?php endif; ?>
                                    <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                    <a href="<?php echo e(url('user/purchase_requests')); ?>" name="btn" class="btn btn-secondary">Back</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/forms/form-tooltip-valid.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/pickers/daterange/moment.min.js')); ?>"></script>
    <script tyle="text/javascript">
    $(function() {
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
        $('.spickadate').pickadate({
            format:'dd/mm/yyyy',
            onSet: function(context) {
               
            }
        });
        $('.epickadate').pickadate({
            format:'dd/mm/yyyy'
        });
        $('.spickadate').change(function() {
            var id=$(this).data("id");
            var v=$(this).val();            
            $('#end_date'+id).val('')
            $('#end_date'+id).pickadate('picker').set('min',$(this).val());
        });
        $('.epickadate').change(function() {
            var id=$(this).data("id");
            var v=$(this).val(); 
            var v2=$('#start_date'+id).val();
            var a = moment(v2,'D/M/YYYY');
            var b = moment(v,'D/M/YYYY');
            console.log(a+"="+b)
            var diffDays = b.diff(a, 'days');
            $('#remaining_days'+id).text(diffDays);
        });
        $('.accept').change(function() {
            var id=$(this).data("id");
            if($(this).val()=='accept') {
                $('#row'+id).find('input[type="text"]').attr("disabled",false);
                $('#row'+id).find('input[type="number"]').attr("disabled",false);
            } else {
                $('#row'+id).find('input[type="text"]').attr("disabled",true);
                $('#row'+id).find('input[type="number"]').attr("disabled",true);
            }
        });
        $('#save_account').submit(function(e) {
            e.preventDefault();
            var form_data=$(this).serialize();
            $.ajax({
                url:'<?php echo e(url('user/save_accounts')); ?>',
                data:form_data,
                type:'post',
                dataType:'json',
                beforeSend:function() {
                    $('#loader').show();
                },
                success:function(res) {
                    if(res.success) {
                        window.location="<?php echo e(url('user/purchase_requests')); ?>"
                    } else {
                        var str='';
                        $.each(res.errors,function(index,item) {
                            str+=item+'<br/>';
                        });
                        $('#error').html(str)
                    }
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('Error - ' + errorMessage);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) { 
                $('#error').html(errorThrown);
            });
        });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/users/open_account_request.blade.php ENDPATH**/ ?>