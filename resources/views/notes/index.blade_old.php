@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Notes List')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/js/pickers/datetime/jquery.datetimepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<div class="row">
   <div class="col-md-12"><a href="{{ route('notes.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New Note</a></div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notes</h4>
                </div>
                <div class="card-content invoice-list-wrapper">
                    <div class="card-body card-dashboard dataTables_wrapper">
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
                        <section class="invoice-list-wrapper">
                        <div class="action-dropdown-btn d-none">
                            <div class="dropdown invoice-filter-action">
                                <button class="btn border dropdown-toggle mr-1" type="button" id="invoice-filter-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter Notes
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-filter-btn">
                                    <a class="dropdown-item" href="#">Assigned</a>
                                    <a class="dropdown-item" href="#">Pending</a>
                                    <a class="dropdown-item" href="#">Paid</a>
                                    <a class="dropdown-item" href="#">Completed</a>
                                </div>
                            </div>
                            <div class="dropdown invoice-options">
                                <button class="btn border dropdown-toggle mr-2" type="button" id="invoice-options-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">View</a>
                                    <a class="dropdown-item" href="#">Send</a>
                                </div>
                            </div>
                        </div>
                            <div class="table-responsive">
                            <table class="table invoice-data-table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Contact Number</th>
                                        <th>Note</th>
                                        <th>Created By</th>
                                        <th>Tags<br/>Assigned To</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($notes as $note)
                                    <tr> 
                                    <td></td> 
                                    <td><a href="{{ route('notes.show', $note->notes_id)}}">{{Helper::get_invoice_no($note->notes_id)}}</a></td>
                                    <td>{{$note->creation_time->format('d/m/Y h:i A')}}</td>
                                    <td>{{$note->contact_no}}</td>  
                                    <td>{{ substr($note->note,0,10) }}..</td>  
                                    <td>{{$note->create->name}} <br/>({{$note->create->email}})</td>  
                                    <td>{{$note->tags}}<br/>{{$note->assign->name}} <br/>({{$note->assign->email}})</td>  
                                    <td>
                                        <div class="invoice-action">
                                    @if(auth()->check() && auth()->user()->hasRole('Admin'))
                                        <a href="{{ route('notes.edit', $note->notes_id)}}" class="invoice-action-view mr-1"><i class="bx bx-edit"></i></i></a> <a class="delete text-danger" data-id="{{ $note->notes_id }}" data-route="{{ route('notes.destroy', $note->notes_id) }}" data-toggle="modal" data-target="#deleteDep"><i class="bx bx-trash"></i></a>
                                    @endif
                                        <a href="#" class="text-info" data-toggle="modal" data-target="#subNote" data-id="{{$note->notes_id}}"><i class="bx bx-show-alt"></i></a>
                                        </div>
                                    </td>  
                                    </tr>
                                @endforeach
                               </tbody>
                            </table>
                        </div>
                    </section>
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
                    Are you sure you want to delete this Note?                    
                    <input type="hidden" id="note" name="note_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="subNote" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="subNote" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ url('notes/save_sub_note') }}" method="post" id="sub_note_form">
            @method('POST')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Sub Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div id="sub_note_error" class="text-danger"></div>                   
                    <input type="hidden" id="note_id" name="note_id">
                    <label for="date">Date *</label>
                    {!! Form::input('text','date',date('Y/m/d H:i'), ['class' => 'form-control','id'=>'datetime']) !!}                   
                    <label for="assign_to">Assign To <small>leave it blank to keep it as it is</small></label>
                    {!! Form::select('assign_to', $users, 0, ['class' => 'form-control chosen-select']) !!}
                    <label for="sub_note">Enter sub note*</label>
                    <textarea name="sub_note" class="form-control"></textarea>  

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/datetime/jquery.datetimepicker.full.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
    <script tyle="text/javascript">
    $(function() {
        $('.deleteDep').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var note = button.data('id'); 
            var action = button.data('route');
            var modal = $(this);
            $('#delete_form').attr("action",action);
            modal.find('.modal-body #note').val(note);
        });
        $('#subNote').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var note = button.data('id'); 
            var action = button.data('route');
            var modal = $(this);
            modal.find('.modal-body #note_id').val(note);
        });
        $('#sub_note_form').submit(function(e) {
            e.preventDefault();
            var fdata=$(this).serialize();
            $.ajax({
                url:"{{url('notes/save_sub_note')}}",
                data:fdata,
                type:'POST',
                dataType:'json',
                success:function(res) {
                    if(res.success)  {
                        location.reload();
                    }else {
                        for(i=0;i<res.length;i++)
                            $('#sub_note_error').html(res[i]+'<br/>');
                    }
                }
    });
        });
    $('#datetime').datetimepicker({
            timepicker:true,
            mask:true
        });
});
    </script>
@endsection