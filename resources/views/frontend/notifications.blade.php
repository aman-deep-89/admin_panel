@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Notifications')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/widgets.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                            <div class="">
                                    <div class="col-12">
                                        <div class="card widget-todo">
                                          <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                            <h4 class="card-title d-flex">
                                              <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Notifications
                                            </h4>
                                          </div>
                                          <div class="card-body px-0 py-1">
                                            <ul class="widget-todo-list-wrapper" id="widget-todo-list">
                                                @foreach($notifications as $comp)  
                                                    <li class="widget-todo-item">
                                                        <div class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                                        <div class="widget-todo-title-area d-flex align-items-center">
                                                            <span class="widget-todo-title ml-0"><strong>{{$comp->notification_title}}</strong></span>
                                                        </div>
                                                        <div class="widget-todo-item-action d-flex align-items-center">
                                                            <div class="badge badge-pill badge-light-success mr-1">{{ $comp->created_at }}</div>
                                                            <div class="avatar bg-rgba-primary m-0 mr-50">
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <p><p>{{$comp->notification_text }}</p>
                                                    </li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>   
@endsection