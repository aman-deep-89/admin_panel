
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu 
<?php if(isset($configData['navbarType'])): ?><?php echo e($configData['navbarClass']); ?> <?php endif; ?>" 
data-bgcolor="<?php if(isset($configData['navbarBgColor'])): ?><?php echo e($configData['navbarBgColor']); ?><?php endif; ?>">
  <div class="navbar-wrapper">
    <div class="navbar-container content p-0 pl-1">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">     
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs pr-0" href="#"><i class="ficon bx bx-menu"></i></a></li>
          </ul>         
        </div>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-language nav-item mr-md-4 mr-2">
            <a class="nav-link" id="dropdown-flag" href="#">
              <span class="">Balance:- <?php echo e(getenv('CURRENCY')); ?> <?php echo e(Auth::user()->current_balance); ?> </span>
            </a>            
          </li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
          <?php if(auth()->user()->hasRole('admin')): ?>
            <?php if(isset($notification)): ?>
            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"><?php echo e(sizeof($notification)); ?></span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title"><?php echo e(sizeof($notification)); ?> new Notification</span></div>
              </li>
              <li class="scrollable-container media-list">
                
                <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key>5) break ?>
                    <a class="d-flex justify-content-between" href="<?php echo e(url('user/open_request/'.$item->purchase_id)); ?>">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar mr-1 m-0"><img src="<?php echo e($item->users->profile_img!='' ? asset('images/avatar/'.$item->users->profile_img) :asset('images/logo/logo.png')); ?>" alt="avatar" height="39" width="39"></div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading"><span class="text-bold-500"><?php echo e($item->users->username); ?> bought <?php echo e($item->quantity); ?> accounts of <u><?php echo e($item->products->name); ?></u></h6><small class="notification-text"><?php echo e($item->p_creation_date->format('M, d Y')); ?></small>
                    </div>
                  </div></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="<?php echo e(url('user/purchase_requests')); ?>">Read all notifications</a></li>
            </ul>
            </li>
            <?php endif; ?>
            <?php if(isset($issues)): ?>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-message bx-burst bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"><?php echo e(sizeof($issues)); ?></span></a> 
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title"><?php echo e(sizeof($notification)); ?> new Notification</span></div>
                </li>
                <li class="scrollable-container media-list">                                 
                <?php $__currentLoopData = $issues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key>5) break ?>
                    <a class="d-flex justify-content-between" href="<?php echo e(url('user/open_issue/'.$item->id)); ?>">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar mr-1 m-0"><img src="<?php echo e($item->purchase_detail->purchases->users->profile_img!='' ? asset('images/avatar/'.$item->purchase_detail->purchases->users->profile_img) :asset('images/logo/logo.png')); ?>" alt="avatar" height="39" width="39"></div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading"><span class="text-bold-500"><?php echo e($item->purchase_detail->purchases->users->username); ?> raised issue for <?php echo e($item->purchase_detail->purchases->products->name); ?></u></h6><small class="notification-text"><?php echo e($item->created_at->format('M, d Y')); ?></small>
                    </div>
                  </div></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
              </li>
              </ul>
            </li>
            <?php endif; ?>
          <?php endif; ?>
          <?php if(auth()->user()->hasRole('user') && isset($user_notification)): ?>
            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"><?php echo e(sizeof($user_notification)); ?></span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title"><?php echo e(sizeof($user_notification)); ?> new Notification</span></div>
              </li>
              <li class="scrollable-container media-list">
                
                <?php $__currentLoopData = $user_notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key>5) break ?>
                    <a class="d-flex justify-content-between" href="<?php echo e(url('open_purchase_account/'.$item->purchase_id)); ?>">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar mr-1 m-0"><img src="<?php echo e($item->profile_img!='' ? asset('images/avatar/'.$item->profile_img) :asset('images/logo/logo.png')); ?>" alt="avatar" height="39" width="39"></div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading"><span class="text-bold-500">Purchase request for <u><?php echo e($item->name); ?></u> of <?php echo e($item->pd_quantity); ?> has been <u><?php echo e($item->pd_status); ?></u></h6><small class="notification-text"><?php echo e($item->p_creation_date); ?></small>
                    </div>
                  </div></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="<?php echo e(url('view_all_notifications')); ?>">View All notifications</a></li>
            </ul>
            </li>
          <?php endif; ?>
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name"><?php echo e(Auth::user()->name); ?></span>
                <span class="user-status text-muted"><?php echo e(Auth::user()->email); ?></span>
              </div>
              <span><img class="round" src="<?php echo e(Auth::user()->profile_img!='' ? asset('images/avatar/'.Auth::user()->profile_img) :asset('images/logo/logo.png')); ?>" alt="avatar" height="40" width="40"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0">
              <div class="dropdown-divider mb-0"></div>
              <a class="dropdown-item" href="<?php echo e(url('/logout')); ?>"><i class="bx bx-power-off mr-50"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/panels/navbar.blade.php ENDPATH**/ ?>