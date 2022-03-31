{{-- navabar  --}}
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu 
@if(isset($configData['navbarType'])){{$configData['navbarClass']}} @endif" 
data-bgcolor="@if(isset($configData['navbarBgColor'])){{$configData['navbarBgColor']}}@endif">
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
              <span class="">Balance:- {{ getenv('CURRENCY')}} {{ Auth::user()->current_balance}} </span>
            </a>            
          </li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
          @if(auth()->user()->hasRole('admin'))
            @if(isset($notification))
            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">{{ sizeof($notification)}}</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">{{ sizeof($notification)}} new Notification</span></div>
              </li>
              <li class="scrollable-container media-list">
                
                @foreach ($notification as $key=>$item)
                <?php if($key>5) break ?>
                    <a class="d-flex justify-content-between" href="{{ url('user/open_request/'.$item->purchase_id)}}">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar mr-1 m-0"><img src="{{ $item->users->profile_img!='' ? asset('images/avatar/'.$item->users->profile_img) :asset('images/logo/logo.png') }}" alt="avatar" height="39" width="39"></div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading"><span class="text-bold-500">{{ $item->users->username }} bought {{ $item->quantity}} accounts of <u>{{$item->products->name}}</u></h6><small class="notification-text">{{$item->p_creation_date->format('M, d Y')}}</small>
                    </div>
                  </div></a>
                @endforeach
                
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="{{ url('user/purchase_requests')}}">Read all notifications</a></li>
            </ul>
            </li>
            @endif
            @if (isset($issues))
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-message bx-burst bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">{{ sizeof($issues)}}</span></a> 
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">{{ sizeof($notification)}} new Notification</span></div>
                </li>
                <li class="scrollable-container media-list">                                 
                @foreach ($issues as $key=>$item)
                <?php if($key>5) break ?>
                    <a class="d-flex justify-content-between" href="{{ url('user/open_issue/'.$item->id)}}">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar mr-1 m-0"><img src="{{ $item->purchase_detail->purchases->users->profile_img!='' ? asset('images/avatar/'.$item->purchase_detail->purchases->users->profile_img) :asset('images/logo/logo.png') }}" alt="avatar" height="39" width="39"></div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading"><span class="text-bold-500">{{ $item->purchase_detail->purchases->users->username }} raised issue for {{ $item->purchase_detail->purchases->products->name }}</u></h6><small class="notification-text">{{$item->created_at->format('M, d Y')}}</small>
                    </div>
                  </div></a>
                @endforeach                
              </li>
              </ul>
            </li>
            @endif
          @endif
          @if(auth()->user()->hasRole('user') && isset($user_notification))
            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">{{ sizeof($user_notification)}}</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">{{ sizeof($user_notification)}} new Notification</span></div>
              </li>
              <li class="scrollable-container media-list">
                
                @foreach ($user_notification as $key=>$item)
                <?php if($key>5) break ?>
                    <a class="d-flex justify-content-between" href="{{ url('open_purchase_account/'.$item->purchase_id)}}">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar mr-1 m-0"><img src="{{ $item->profile_img!='' ? asset('images/avatar/'.$item->profile_img) :asset('images/logo/logo.png') }}" alt="avatar" height="39" width="39"></div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading"><span class="text-bold-500">Purchase request for <u>{{$item->name}}</u> of {{ $item->pd_quantity}} has been <u>{{$item->pd_status}}</u></h6><small class="notification-text">{{$item->p_creation_date}}</small>
                    </div>
                  </div></a>
                @endforeach
                
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="{{ url('view_all_notifications')}}">View All notifications</a></li>
            </ul>
            </li>
          @endif
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name">{{Auth::user()->name}}</span>
                <span class="user-status text-muted">{{Auth::user()->email}}</span>
              </div>
              <span><img class="round" src="{{ Auth::user()->profile_img!='' ? asset('images/avatar/'.Auth::user()->profile_img) :asset('images/logo/logo.png') }}" alt="avatar" height="40" width="40"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0">
              <div class="dropdown-divider mb-0"></div>
              <a class="dropdown-item" href="{{url('/logout')}}"><i class="bx bx-power-off mr-50"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
