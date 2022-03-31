<?php $__env->startSection('title','Dashboard Analytics'); ?>

<?php $__env->startSection('vendor-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/charts/apexcharts.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/css/extensions/dragula.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/dashboard-analytics.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row">
      <!-- Website Analytics Starts-->
      <div class="col-md-6 col-sm-12">
        <div class="card">
          <?php if(auth()->user()->hasRole('admin')): ?>
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Website Analytics</h4>
          </div>
          <div class="card-content">
            <div class="card-body pb-1">
              <div class="d-flex justify-content-around align-items-center flex-wrap">
                <div class="user-analytics">
                  <i class="bx bx-user mr-25 align-middle"></i>
                  <span class="align-middle text-muted">Users</span>
                  <div class="d-flex">
                    <h3 class="mt-1 ml-50"><?php echo e($users); ?></h3>
                  </div>
                </div>
                <div class="sessions-analytics">
                  <i class="bx bx-cart align-middle mr-25"></i>
                  <span class="align-middle text-muted">Products</span>
                  <div class="d-flex">
                    <h3 class="mt-1 ml-50"><?php echo e($products); ?></h3>
                  </div>
                </div>
                <div class="bounce-rate-analytics">
                  <i class="bx bx-trending-up align-middle mr-25"></i>
                  <span class="align-middle text-muted">Active Accounts</span>
                  <div class="d-flex">
                    <h3 class="mt-1 ml-50"><?php echo e($active_accounts); ?></h3>
                  </div>
                </div>
              </div>
              <div id="analytics-bar-chart"></div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if(auth()->user()->hasRole('user')): ?>
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Expiring Accounts within 10 days</h4>
        </div>
        <div class="card-content">
          <div class="card-body pb-1">
            <ul class="widget-todo-list-wrapper" id="widget-todo-list">
              <?php if($expiring_accounts): ?>
              <?php $__currentLoopData = $expiring_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                      
                <li class="widget-todo-item">
                  <div class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                    <div class="widget-todo-title-area d-flex align-items-center">
                      <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                      <p class="widget-todo-title ml-50"><?php echo e($item->name); ?> <br><small><?php echo e($item->end_date); ?></small></p>
                    </div>
                    <div class="widget-todo-item-action d-flex align-items-center">
                      <div class="badge badge-pill badge-light-success mr-1"><?php echo e($item->remaining_days); ?> days remaining</div>
                      <div class="avatar bg-rgba-primary m-0 mr-50">
                        <div class="avatar-content">
                          <span class="font-size-base text-primary"><?php echo e($item->quantity); ?></span>
                        </div>
                      </div>                     
                    </div>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?> 
                  No account is expiring in next 10 days
                <?php endif; ?>
            </ul>            
          </div>
        </div>
      </div>
        <?php endif; ?>
      </div>
      
      <div class="col-md-6 col-sm-12">
        <div class="row">         
          <div class="col-xl-12 col-md-6 col-12">
            <div class="row">
              <?php if(auth()->user()->hasRole('admin')): ?>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-primary font-medium-2"></i>
                        </div>
                      </div>
                      <div class="total-amount">
                        <h5 class="mb-0"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($monthly_income->total); ?></h5>
                        <small class="text-muted">Income This Month</small>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-warning font-medium-2"></i>
                        </div>
                      </div>
                      <div class="total-amount">
                        <h5 class="mb-0"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($income->total); ?></h5>
                        <small class="text-muted">Total Income</small>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>              
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-primary font-medium-2"></i>
                        </div>
                      </div>
                      <div class="total-amount">
                        <h5 class="mb-0"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($total_balance->total); ?></h5>
                        <small class="text-muted">Total User Balance</small>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-warning font-medium-2"></i>
                        </div>
                      </div>
                      <div class="total-amount">
                        <h5 class="mb-0"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($highest_balance->balance); ?></h5>
                        <small class="text-muted">Highest Balance (<?php echo e($highest_balance->username); ?>)</small>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>              
              <div class="col-12">
                <div class="card">
                  <div class="card-header pb-0">User Statistics</div>
                  <div class="card-body pb-0 pt-0">
                    <div id="bar-negative-chart"></div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <?php if(auth()->user()->hasRole('user')): ?>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-primary font-medium-2"></i>
                        </div>
                      </div>
                      <div class="total-amount">
                        <h5 class="mb-0"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($monthly_income->total); ?></h5>
                        <small class="text-muted">Spending This Month</small>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <i class="bx bx-dollar text-warning font-medium-2"></i>
                        </div>
                      </div>
                      <div class="total-amount">
                        <h5 class="mb-0"><?php echo e(getenv('CURRENCY')); ?> <?php echo e($income->total); ?></h5>
                        <small class="text-muted">Total Spending</small>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Task Card Starts -->
      <div class="col-lg-6">
        <div class="row">
          <div class="col-12">
            <div class="card widget-todo">
              <div class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="card-title d-flex mb-25 mb-sm-0">
                  <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Pending Purchase Request
                </h4>
              </div>
              <div class="card-body px-0 py-1">
                <ul class="widget-todo-list-wrapper" id="widget-todo-list">
                  <?php $__currentLoopData = $pending_purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                      
                    <li class="widget-todo-item">
                      <div class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50 <?php if($item->p_status=='pending') echo 'bg-danger bg-light'; else if($item->p_status=='completed') echo 'bg-success bg-light'; ?>">
                        <div class="widget-todo-title-area d-flex align-items-center">
                          <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                          <p class="widget-todo-title ml-50"><?php echo e($item->products->name); ?> <br><small><?php echo e($item->p_creation_date->format('d-m-Y h:i A')); ?></small></p>
                        </div>
                        <div class="widget-todo-item-action d-flex align-items-center">
                          <div class="badge badge-pill badge-light-success mr-1"><?php echo e($item->users->username); ?></div>
                          <div class="avatar bg-rgba-primary m-0 mr-50">
                            <div class="avatar-content">
                              <span class="font-size-base text-primary"><?php
                              $num=0;
                                foreach($item->purchase_detail as $val)
                                  if($val['pd_status']=='pending') $num++;
                              ?></span>
                            </div>
                          </div>
                          <?php if(auth()->user()->hasRole('admin')): ?>
                          <div class="dropdown">
                            <span
                              class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="<?php echo e(url('user/open_request/'.$item->purchase_id)); ?>"><i class="bx bx-eye mr-1"></i> View</a>
                            </div>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Daily Financials Card Starts -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              Pending Balance Requests
            </h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <ul class="widget-timeline mb-0">
                <?php $__currentLoopData = $pending_balance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="timeline-items timeline-icon-primary active">
                      <?php if(auth()->user()->hasRole('admin')): ?>
                        <a href="<?php echo e(url('user/open_balance_request/'.$item->bh_id)); ?>">  
                        <?php else: ?> 
                          <a href="#">
                      <?php endif; ?>
                      <div class="timeline-time"><?php echo e($item->create_dt); ?></div>
                      <h6 class="timeline-title"><?php echo e($item->username); ?> requested <?php echo e(getenv('CURRENCY')); ?><?php echo e($item->requested_amount); ?> </h6>
                      <div class="timeline-content"> 
                                             
                        <?php if($item->bh_images) { $images=json_decode($item->bh_images,true); ?>
                           <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(getenv('app_url').Storage::url('app/public/'.$img)); ?>" alt="<?= $img ?>" height="23" width="19"
                           class="mr-50">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        <?php } ?>
                      </div>
                    </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                              
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Analytics end -->
  <?php
    $chart2=$months=[];
    foreach($user_chart as $val) {
      $chart2[$val->user_id]['username']=$val->username;
      $chart2[$val->user_id]['month'][$val->mon]=$val;
      $months[$val->mon]=$val->mon_name;
    }
    $max=0;
  ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('vendor-scripts'); ?>
<script src="<?php echo e(asset('vendors/js/charts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/js/extensions/dragula.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('js/scripts/pages/dashboard-analytics.js')); ?>"></script>
<script type="text/javascript">
  $(function() {
    var $primary = '#5A8DEE';
  var $success = '#39DA8A';
  var $danger = '#FF5B5C';
  var $warning = '#FDAC41';
  var $info = '#00CFDD';
  var $label_color = '#475f7b';
  var $primary_light = '#E2ECFF';
  var $danger_light = '#ffeed9';
  var $gray_light = '#828D99';
  var $sub_label_color = "#596778";
  var $radial_bg = "#e7edf3";
    var analyticsBarChartOptions = {
    chart: {
      height: 260,     
      type: 'bar',
      toolbar: {
        show: false
      }
    }, 
    title:{
        text:'Request Statistics',
      },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '20%',
        endingShape: 'rounded'
      },
    },
    legend: {
      horizontalAlign: 'right',
      offsetY: -10,
      markers: {
        radius: 50,
        height: 8,
        width: 8
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: [$primary, $success,$danger],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "vertical",
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 70, 100]
      },
    },
    series: [{
      name: 'Total',
      data: [<?php foreach($account_chart as $val) { 
        echo $val->total_qty.",";
        if($max<$val->total_qty) $max=$val->total_qty;        
       } ?>]
    }, {
      name: 'Accepted',
      data: [<?php foreach($account_chart as $val) { 
        echo $val->accepted.",";
       } ?>]
    }, {
      name: 'Rejected',
      data: [<?php foreach($account_chart as $val) { 
        echo $val->rejected.",";
       } ?>]
    }],
    xaxis: {
      categories: [ <?php foreach($account_chart as $val) { 
        echo "'".$val->mon_name."',";
       } ?>
    ],
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      labels: {
        style: {
          colors: $gray_light
        }
      }
    },
    yaxis: {
      min: 0,
      max: <?= ($max+3) ?>,
      tickAmount: 3,
      labels: {
        style: {
          color: $gray_light
        }
      }
    },
    legend: {
      show: false
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val
        }
      }
    }
  }

  var analyticsBarChart = new ApexCharts(
    document.querySelector("#analytics-bar-chart"),
    analyticsBarChartOptions
  );
  analyticsBarChart.render();
  // Stacked Bar Nagetive Chart
  // ----------------------------------
  var barNegativeChartoptions = {
    chart: {
      height: 200,
      type: 'bar',
      toolbar: {
        show: false
      }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '10%',
        endingShape: 'rounded'
      },
    },
    legend: {
      show:true,
      horizontalAlign: 'right',
      offsetY: -10,
      markers: {
        radius: 50,
        height: 8,
        width: 8
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: [$warning, $info,$radial_bg],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "vertical",
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 70, 100]
      },
    },
    series: [
      <?php 
      $max=0;
      foreach($chart2 as $key=>$val) { ?>
          {
            name: '<?php echo $val['username'] ?>',
            data: [ <?php foreach($val['month'] as $v) { echo $v->total_qty.','; if($max<$v->total_qty) $max=$v->total_qty; } ?> ]
        },
    <?php } ?>
    ],
    xaxis: {
      categories: [ <?php foreach($months as $val) { 
        echo "'".$val."',";
       } ?>
    ],
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      labels: {
        style: {
          colors: $gray_light
        }
      }
    },
    yaxis: {
      min: 0,
      max: <?= ($max+3) ?>,
      tickAmount: 3,
      labels: {
        style: {
          color: $gray_light
        }
      }
    },
    legend: {
      show: true
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val
        }
      }
    }
  }    
  var barNegativeChart = new ApexCharts(
    document.querySelector("#bar-negative-chart"),
    barNegativeChartoptions
  );

  barNegativeChart.render();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_mgmt\resources\views/pages/dashboard-analytics.blade.php ENDPATH**/ ?>