@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Purchase History')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchase History</h4>
                </div>
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
                            <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th> <th>Product</th><th>UserID</th><th>Password</th><th>Start Date</th><th>End Date</th><th>Remaining Days</th><th>Status</th><th>Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($list as $comp)  
                                    <tr>  
                                    <td>{{$comp->pd_id}}</td>  
                                    <td>{{$comp->name}}</td>  
                                    <td>{{$comp->pd_username}}</td>  
                                    <td>{{$comp->pd_password}}</td>  
                                    <td>{{$comp->pd_start_date}}</td>  
                                    <td>{{$comp->pd_end_date}}</td>  
                                    <td><?php $comp->diff>0 ? $comp->diff.' Days' : '<span class="badge badge-danger">Expired</span>'; ?> </td>  
                                    <td> {{ $comp->pd_status}} <br/> </td>
                                    <td><a href="{{ url('open_purchase_account/'.$comp->purchase_id) }}" class="btn btn-sm btn-primary">Open</a></td>
                                    </tr>
                                    @endforeach
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th> <th>Product</th><th>UserID</th><th>Password</th><th>Start Date</th><th>End Date</th><th>Remaining Days</th><th>Status</th><th>Action</th>
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