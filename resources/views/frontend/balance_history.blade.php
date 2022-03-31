@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Balance History')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<div class="row">
   <div class="col-md-12"><a href="{{ url('balance/add_request') }}" class="btn btn-primary">Add Balance</a></div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Balance History</h4>
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
                                        <th>ID</th><th>Date</th> <th>Balance</th><th>Description</th><th>Status</th><th>Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($list as $comp)  
                                    <tr>  
                                    <td>{{$comp->bh_id}}</td>  
                                    <td>{{$comp->date}}</td>  
                                    <td>$ {{$comp->requested_amount}}</td>  
                                    <td>{{$comp->bh_description}}</td>  
                                    <td>{{$comp->bh_status}}</td>  
                                    <td>
                                        @if ($comp->bh_status=='pending')
                                            <a href="{{ url('balance/edit_request', $comp->bh_id)}}" class="btn btn-sm btn-primary">Edit</a> <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $comp->bh_id }}" data-route="{{ url('balance/delete_request', $comp->bh_id) }}" data-toggle="modal" data-target="#deleteDep">Delete</button>
                                        @endif
                                    </td>  
                                    </tr>
                                @endforeach
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th> <th>Username</th> <th>Date</th> <th>Balance</th> <th>Description</th> <th>Actions</th>
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
    <div class="modal-dialog modal-sm" role="document">
        <form action="" method="post" id="delete_form">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this request?
                    <input type="hidden" id="request_id" name="request_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
    <script tyle="text/javascript">
        $('#deleteDep').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var request_id = button.data('id');
            var action = button.data('route');
            $('#delete_form').attr("action",action);
            var modal = $(this);
            modal.find('.modal-body #request_id').val(request_id);
        });
    </script>
@endsection