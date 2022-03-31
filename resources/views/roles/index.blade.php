@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Role List')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<div class="row">
   <div class="col-md-12"><a href="{{ route('role.create') }}" class="btn btn-primary">Add New Role</a></div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($roles as $role)
                                    <tr>  
                                    <td>{{$role->rid}}</td>  
                                    <td>{{$role->rname}}</td>  
                                    <td>{{$role->rslug}}</td>  
                                    <td>{{$role->per_name}}</td>  
                                    <td><a href="{{ route('role.edit', $role->rid)}}" class="btn btn-primary btn-sm">Edit</a> <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $role->rid }}" data-route="{{ route('role.destroy', $role->rid) }}" data-toggle="modal" data-target="#deleteDep">Delete</button></td>  
                                    </tr>
                                @endforeach
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
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
    <div class="modal-dialog modal-md" role="document">
        <form action="#" method="post" id="delete_form">
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
                    Are you sure you want to delete this role?
                    <input type="hidden" id="role" name="role_id">
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
            var role = button.data('id'); 
            var action = button.data('route');
            var modal = $(this);
            $('#delete_form').attr("action",action);
            modal.find('.modal-body #role').val(role);
        });
    </script>
@endsection