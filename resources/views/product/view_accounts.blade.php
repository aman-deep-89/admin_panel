@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Account List')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<div class="row">
   
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Account List</h4>
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
                                        <th>UserName</th>
                                        <th>Password</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Remaining Days</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($product->purchases as $comp)
                                    @foreach ($comp->purchase_detail as $item)
                                        @if($item->pd_status=='accepted')
                                        <tr>  
                                            <td>{{$item->pd_id}}</td>  
                                            <td>{{$item->pd_username}}</td>  
                                            <td>{{$item->pd_password}}</td>  
                                            <td>{{$item->pd_start_date}}</td>  
                                            <td>{{$item->pd_end_date}}</td>  
                                            <td><?php
                                                $date1=date_create(date('Y-m-d'));
                                                $date2=date_create($item->pd_end_date);
                                                $diff=date_diff($date2,$date1);
                                                echo $diff->format("%a days");
                                            ?></td>  
                                            <td>{{$item->pd_creation_date }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    
                                @endforeach
                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>UserName</th>
                                        <th>Password</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Remaining Days</th>
                                        <th>Created At</th>
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
                    Are you sure you want to delete <span id="pname"></span>?
                    <input type="hidden" id="product" name="id">
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
            var product = button.data('id');
            var product_name = button.data('name');
            var action = button.data('route');
            $('#delete_form').attr("action",action);
            var modal = $(this);
            modal.find('.modal-body #product').val(product);
            modal.find('.modal-body #pname').val(product_name);
        });
    </script>
@endsection