
    <!-- BEGIN: Vendor JS-->
    <script>
        var assetBaseUrl = "{{ asset('') }}";
    </script>
    <script src="{{asset('vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @yield('vendor-scripts')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    @if($configData['mainLayoutType'] == 'vertical-menu')
    <script src="{{asset('js/scripts/configs/vertical-menu-light.js')}}"></script>
    @else
    <script src="{{asset('js/scripts/configs/horizontal-menu.js')}}"></script>
    @endif
    <script src="{{asset('js/core/app-menu.js')}}"></script>
    <script src="{{asset('js/core/app.js')}}"></script>
    <script src="{{asset('js/scripts/components.js')}}"></script>
    <script src="{{asset('js/scripts/footer.js')}}"></script>
    <script src="{{asset('js/scripts/customizer.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>    
    <script type="text/javascript">
        $(function() {
            @if(auth()->check() && auth()->user()->hasRole('user'))
            setInterval(function () {
                $.ajax({
                    url:'{{ url('check_notification') }}',
                    data:'_token={{csrf_token()}}',
                    type:'post',
                    dataType:'json',
                    success:function(res) {
                        if(res.success) {
                            $.each(res.notifications,function(index,item) {
                                if(item.pd_updated==1) 
                                    toastr.success('Your request has been updated','Status Update for '+item.name, { "closeButton": true, positionClass: 'toast-bottom-right',"timeOut": 0  });
                                else if(item.pd_status=='accepted')
                                    toastr.success('Your request has been '+item.pd_status+' for 1 account','Status Update for '+item.name, { "closeButton": true, positionClass: 'toast-bottom-right',"timeOut": 0  });
                                else 
                                    toastr.error('Your request has been '+item.pd_status+' for 1 account','Status Update for '+item.name, { "closeButton": true, positionClass: 'toast-bottom-right',"timeOut": 0  });
                            });
                        }
                    }
                });
            },60000);
            @endif
        });
    </script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    @yield('page-scripts')
    <!-- END: Page JS-->
