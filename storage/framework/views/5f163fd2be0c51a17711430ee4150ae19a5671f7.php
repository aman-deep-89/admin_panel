
<?php if($configData['mainLayoutType'] == 'vertical-menu'): ?>
<div class="main-menu menu-fixed <?php if($configData['theme'] === 'light'): ?> <?php echo e("menu-light"); ?> <?php else: ?> <?php echo e('menu-dark'); ?> <?php endif; ?> menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
          <a class="navbar-brand" href="<?php echo e(asset('/')); ?>">
          <div class="brand-logo">
            <img src="<?php echo e(asset('images/logo/logo.png')); ?>" class="logo" alt="">
          </div>
          <h2 class="brand-text mb-0">
            <?php if(!empty($configData['templateTitle']) && isset($configData['templateTitle'])): ?>
            <?php echo e($configData['templateTitle']); ?>

            <?php else: ?>
            Frest
            <?php endif; ?>
          </h2>
          </a>
      </li>
          <li class="nav-item nav-toggle">
          <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
            <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
            <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
          </a>
          </li>
      </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
          <li class=" nav-item"><a href="<?php echo e(route('home')); ?>"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>
          <li class=" navigation-header"><span>Apps</span>
          </li>
          <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?> :
          <li class=" nav-item"><a href="<?php echo e(url('/user')); ?>"><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Todo">User Accounts</span></a>
            <ul class="menu-content">
              <li><a href="<?php echo e(url('/user')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Users</span></a>
              </li>             
          </ul>
          </li>
          <li class=" nav-item"><a href="<?php echo e(url('/user')); ?>"><i class="menu-livicon" data-icon="loader-10"></i><span class="menu-title" data-i18n="Todo">Products</span></a>
            <ul class="menu-content">
              <li><a href="<?php echo e(route('product.create')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Create</span></a>
              </li>
              <li><a href="<?php echo e(route('product.index')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">View</span></a>
              </li>
          </ul>
          </li>
          <li class=" nav-item"><a href="<?php echo e(url('/')); ?>"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Todo">Balance</span></a>
            <ul class="menu-content">
              <li><a href="<?php echo e(url('user/add_balance')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Add Balance</span></a>
              </li>
              <li><a href="<?php echo e(url('user/balance_history')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Balance History</span></a>
              </li>
              <li><a href="<?php echo e(url('user/balance_requests')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Balance Requests</span></a>
              </li>
            </ul>
            </li>
            <li class=" nav-item"><a href="<?php echo e(url('/')); ?>"><i class="menu-livicon" data-icon="shoppingcart"></i><span class="menu-title" data-i18n="Todo">Purchases</span></a>
            <ul class="menu-content">
              <li><a href="<?php echo e(url('user/pending_requests')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Pending Purchase Requests</span></a> </li>
              <li><a href="<?php echo e(url('user/purchase_requests')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Purchase History</span></a> </li>
            </ul>
            </li>
         <li class="nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">Reports</span></a>
            <ul class="menu-content">
                <li><a href="<?php echo e(url('report/purchase_report')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Purchases</span></a>
                </li>
            </ul>
        </li>
          <li class="nav-item"><a href="<?php echo e(route('notification.index')); ?>"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Notifications</span></a></li>
          <li class="nav-item"><a href="<?php echo e(url('view_issues')); ?>"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Issues</span></a></li>
          <?php endif; ?>
          <?php if(auth()->check() && auth()->user()->hasRole('user')): ?> :
          <li class="nav-item"><a href="<?= url('view_product') ?>"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">Products</span></a> </li>
          <li class=" nav-item"><a href="<?= url('view_purchases') ?>"><i class="menu-livicon" data-icon="shoppingcart"></i><span class="menu-title" data-i18n="Invoice">Purchases</span></a></li>
          <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Invoice">Account Balance</span></a>
            <ul class="menu-content">
                <li><a href="<?= url('balance/add_request') ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Add Request</span></a>
                </li>
                <li><a href="<?= url('balance/view_request') ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">View Requests</span></a>
                </li>
            </ul>
          </li> 
        <li class="nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">Reports</span></a>
            <ul class="menu-content">
                <li><a href="<?php echo e(url('report/purchase_report')); ?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Purchases</span></a>
                </li>
            </ul>
        </li>          
        <li class="nav-item"><a href="<?php echo e(url('view_notifications')); ?>"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Notifications</span></a></li>
        <li class="nav-item"><a href="<?php echo e(url('view_issues')); ?>"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Issues</span></a></li>
        <?php endif; ?> 
      </ul>
      </div>
  </div>
<?php endif; ?>

<?php if($configData['mainLayoutType'] == 'horizontal-menu'): ?>
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-light navbar-without-dd-arrow
<?php if($configData['navbarType'] === 'navbar-static'): ?> <?php echo e('navbar-sticky'); ?> <?php endif; ?>" role="navigation" data-menu="menu-wrapper">
  <div class="navbar-header d-xl-none d-block">
      <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
          <a class="navbar-brand" href="<?php echo e(asset('/')); ?>">
          <div class="brand-logo">
            <img src="<?php echo e(asset('images/logo/logo.png')); ?>" class="logo" alt="">
          </div>
          <h2 class="brand-text mb-0">
            <?php if(!empty($configData['templateTitle']) && isset($configData['templateTitle'])): ?>
            <?php echo e($configData['templateTitle']); ?>

            <?php else: ?>
            Admin Panel
            <?php endif; ?>
          </h2>
          </a>
      </li>
      <li class="nav-item nav-toggle">
          <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
          </a>
      </li>
      </ul>
  </div>
  <div class="shadow-bottom"></div>
  <!-- Horizontal menu content-->
  <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="filled">
      <?php if(!empty($menuData[1]) && isset($menuData[1])): ?>
          <?php $__currentLoopData = $menuData[1]->menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="<?php if(isset($menu->submenu)): ?><?php echo e('dropdown'); ?> <?php endif; ?> nav-item" data-menu="dropdown">
          <a class="<?php if(isset($menu->submenu)): ?><?php echo e('dropdown-toggle'); ?> <?php endif; ?> nav-link" href="<?php echo e(asset($menu->url)); ?>"
            <?php if(isset($menu->submenu)): ?><?php echo e('data-toggle=dropdown'); ?> <?php endif; ?> <?php if(isset($menu->newTab)): ?><?php echo e("target=_blank"); ?><?php endif; ?>>
              <i class="menu-livicon" data-icon="<?php echo e($menu->icon); ?>"></i>
              <span><?php echo e(__('locale.'.$menu->name)); ?></span>
          </a>
          <?php if(isset($menu->submenu)): ?>
              <?php echo $__env->make('panels.sidebar-submenu',['menu'=>$menu->submenu], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      </ul>
  </div>
  <!-- /horizontal menu content-->
  </div>
<?php endif; ?>


<?php if($configData['mainLayoutType'] == 'vertical-menu-boxicons'): ?>
<div class="main-menu menu-fixed <?php if($configData['theme'] === 'light'): ?> <?php echo e("menu-light"); ?> <?php else: ?> <?php echo e('menu-dark'); ?> <?php endif; ?> menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
    <li class="nav-item mr-auto">
      <a class="navbar-brand" href="<?php echo e(asset('/')); ?>">
        <div class="brand-logo">
          <img src="<?php echo e(asset('images/logo/logo.png')); ?>" class="logo" alt="">
        </div>
        <h2 class="brand-text mb-0">
          <?php if(!empty($configData['templateTitle']) && isset($configData['templateTitle'])): ?>
          <?php echo e($configData['templateTitle']); ?>

          <?php else: ?>
          Frest
          <?php endif; ?>
        </h2>
      </a>
    </li>
    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc"></i></a></li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
      <?php if(!empty($menuData[2]) && isset($menuData[2])): ?>
      <?php $__currentLoopData = $menuData[2]->menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(isset($menu->navheader)): ?>
              <li class="navigation-header"><span><?php echo e($menu->navheader); ?></span></li>
          <?php else: ?>
          <li class="nav-item <?php echo e((request()->is($menu->url.'*')) ? 'active' : ''); ?>">
            <a href="<?php if(isset($menu->url)): ?><?php echo e(asset($menu->url)); ?> <?php endif; ?>" <?php if(isset($menu->newTab)): ?><?php echo e("target=_blank"); ?><?php endif; ?>>
            <?php if(isset($menu->icon)): ?>
              <i class="<?php echo e($menu->icon); ?>"></i>
            <?php endif; ?>
            <?php if(isset($menu->name)): ?>
              <span class="menu-title"><?php echo e(__('locale.'.$menu->name)); ?></span>
            <?php endif; ?>
            <?php if(isset($menu->tag)): ?>
              <span class="<?php echo e($menu->tagcustom); ?>"><?php echo e($menu->tag); ?></span>
            <?php endif; ?>
           </a>
          <?php if(isset($menu->submenu)): ?>
            <?php echo $__env->make('panels.sidebar-submenu',['menu' => $menu->submenu], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
          </li>
          <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
  </ul>
  </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/panels/sidebar.blade.php ENDPATH**/ ?>