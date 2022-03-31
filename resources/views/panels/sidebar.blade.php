{{-- vertical-menu --}}
@if($configData['mainLayoutType'] == 'vertical-menu')
<div class="main-menu menu-fixed @if($configData['theme'] === 'light') {{"menu-light"}} @else {{'menu-dark'}} @endif menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
          <a class="navbar-brand" href="{{asset('/')}}">
          <div class="brand-logo">
            <img src="{{asset('images/logo/logo.png')}}" class="logo" alt="">
          </div>
          <h2 class="brand-text mb-0">
            @if(!empty($configData['templateTitle']) && isset($configData['templateTitle']))
            {{$configData['templateTitle']}}
            @else
            Frest
            @endif
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
          <li class=" nav-item"><a href="{{ route('home') }}"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>
          <li class=" navigation-header"><span>Apps</span>
          </li>
          @if(auth()->check() && auth()->user()->hasRole('admin')) :
          <li class=" nav-item"><a href="{{ url('/user') }}"><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Todo">User Accounts</span></a>
            <ul class="menu-content">
              <li><a href="{{ url('/user') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Users</span></a>
              </li>             
          </ul>
          </li>
          <li class=" nav-item"><a href="{{ url('/user') }}"><i class="menu-livicon" data-icon="loader-10"></i><span class="menu-title" data-i18n="Todo">Products</span></a>
            <ul class="menu-content">
              <li><a href="{{ route('product.create') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Create</span></a>
              </li>
              <li><a href="{{ route('product.index') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">View</span></a>
              </li>
          </ul>
          </li>
          <li class=" nav-item"><a href="{{ url('/') }}"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Todo">Balance</span></a>
            <ul class="menu-content">
              <li><a href="{{ url('user/add_balance') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Add Balance</span></a>
              </li>
              <li><a href="{{ url('user/balance_history') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Balance History</span></a>
              </li>
              <li><a href="{{ url('user/balance_requests') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Balance Requests</span></a>
              </li>
            </ul>
            </li>
            <li class=" nav-item"><a href="{{ url('/') }}"><i class="menu-livicon" data-icon="shoppingcart"></i><span class="menu-title" data-i18n="Todo">Purchases</span></a>
            <ul class="menu-content">
              <li><a href="{{ url('user/pending_requests') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Pending Purchase Requests</span></a> </li>
              <li><a href="{{ url('user/purchase_requests') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Purchase History</span></a> </li>
            </ul>
            </li>
         <li class="nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">Reports</span></a>
            <ul class="menu-content">
                <li><a href="{{ url('report/purchase_report') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Purchases</span></a>
                </li>
            </ul>
        </li>
          <li class="nav-item"><a href="{{ route('notification.index') }}"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Notifications</span></a></li>
          <li class="nav-item"><a href="{{ url('view_issues') }}"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Issues</span></a></li>
          @endif
          @if(auth()->check() && auth()->user()->hasRole('user')) :
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
                <li><a href="{{ url('report/purchase_report') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Purchases</span></a>
                </li>
            </ul>
        </li>          
        <li class="nav-item"><a href="{{ url('view_notifications') }}"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Notifications</span></a></li>
        <li class="nav-item"><a href="{{ url('view_issues') }}"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Notifications">Issues</span></a></li>
        @endif 
      </ul>
      </div>
  </div>
@endif
{{-- horizontal-menu --}}
@if($configData['mainLayoutType'] == 'horizontal-menu')
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-light navbar-without-dd-arrow
@if($configData['navbarType'] === 'navbar-static') {{'navbar-sticky'}} @endif" role="navigation" data-menu="menu-wrapper">
  <div class="navbar-header d-xl-none d-block">
      <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
          <a class="navbar-brand" href="{{asset('/')}}">
          <div class="brand-logo">
            <img src="{{asset('images/logo/logo.png')}}" class="logo" alt="">
          </div>
          <h2 class="brand-text mb-0">
            @if(!empty($configData['templateTitle']) && isset($configData['templateTitle']))
            {{$configData['templateTitle']}}
            @else
            Admin Panel
            @endif
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
      @if(!empty($menuData[1]) && isset($menuData[1]))
          @foreach ($menuData[1]->menu as $menu)
          <li class="@if(isset($menu->submenu)){{'dropdown'}} @endif nav-item" data-menu="dropdown">
          <a class="@if(isset($menu->submenu)){{'dropdown-toggle'}} @endif nav-link" href="{{asset($menu->url)}}"
            @if(isset($menu->submenu)){{'data-toggle=dropdown'}} @endif @if(isset($menu->newTab)){{"target=_blank"}}@endif>
              <i class="menu-livicon" data-icon="{{$menu->icon}}"></i>
              <span>{{ __('locale.'.$menu->name)}}</span>
          </a>
          @if(isset($menu->submenu))
              @include('panels.sidebar-submenu',['menu'=>$menu->submenu])
          @endif
          </li>
          @endforeach
      @endif
      </ul>
  </div>
  <!-- /horizontal menu content-->
  </div>
@endif

{{-- vertical-box-menu --}}
@if($configData['mainLayoutType'] == 'vertical-menu-boxicons')
<div class="main-menu menu-fixed @if($configData['theme'] === 'light') {{"menu-light"}} @else {{'menu-dark'}} @endif menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
    <li class="nav-item mr-auto">
      <a class="navbar-brand" href="{{asset('/')}}">
        <div class="brand-logo">
          <img src="{{asset('images/logo/logo.png')}}" class="logo" alt="">
        </div>
        <h2 class="brand-text mb-0">
          @if(!empty($configData['templateTitle']) && isset($configData['templateTitle']))
          {{$configData['templateTitle']}}
          @else
          Frest
          @endif
        </h2>
      </a>
    </li>
    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc"></i></a></li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
      @if(!empty($menuData[2]) && isset($menuData[2]))
      @foreach ($menuData[2]->menu as $menu)
          @if(isset($menu->navheader))
              <li class="navigation-header"><span>{{$menu->navheader}}</span></li>
          @else
          <li class="nav-item {{(request()->is($menu->url.'*')) ? 'active' : '' }}">
            <a href="@if(isset($menu->url)){{asset($menu->url)}} @endif" @if(isset($menu->newTab)){{"target=_blank"}}@endif>
            @if(isset($menu->icon))
              <i class="{{$menu->icon}}"></i>
            @endif
            @if(isset($menu->name))
              <span class="menu-title">{{ __('locale.'.$menu->name)}}</span>
            @endif
            @if(isset($menu->tag))
              <span class="{{$menu->tagcustom}}">{{$menu->tag}}</span>
            @endif
           </a>
          @if(isset($menu->submenu))
            @include('panels.sidebar-submenu',['menu' => $menu->submenu])
          @endif
          </li>
          @endif
      @endforeach
      @endif
  </ul>
  </div>
</div>
@endif
