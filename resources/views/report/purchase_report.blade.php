@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','PurchaseReport')
@section('page-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection
@section('content')
<!-- Basic Inputs start -->
<section id="basic-input">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Enter fields</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                  @if($errors->any())
                      @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                      @endforeach
                  @endif
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
                <form action="{{url('report/show_purchase_report') }}" class="needs-validation" method="post" id="report">
                    @csrf
                <fieldset class="form-group row">
                  <div class="col-md-6">
                    <label for="start_date">From Date <small>Leave it blank to show all records</small></label>
                    <input type="text" class="form-control" id="start_date" name="start_date"  placeholder="From" value="{{ old('start_date') }}">
                  </div>
                  <div class="col-md-6">
                      <label for="end_date">End Date <small>Leave it blank to show all records</small></label>
                      <input type="text" class="form-control" id="end_date" name="end_date"  placeholder="Untill" value="{{ old('end_date') }}">
                  </div>
                </fieldset>
                <fieldset class="form-group row">
                @if(auth()->user()->hasRole('admin'))
                  <div class="col-md-6">
                    <label for="user_id">Users</label>
                    {!! Form::select('user_id[]', $users, 0, ['class' => 'form-control chosen-select','id'=>'user_id','multiple'=>'multiple']) !!}
                  </div>
                  @endif
                  <div class="col-md-6">
                    <br/>
                    <button class="btn btn-primary" type="submit">Show Report</button>
                  </div>       
                </fieldset>     
            </form>
            </div>   
            <div class="col-12 table-responsive">
              <table id='report_table' width='100%' class="table">
                  <thead>
                    <tr>
                      <td>Requested By/On</td>
                      <td>Product</td>
                      <td>Username</td>
                      <td>Password</td>
                      <td>Start Date</td>
                      <td>End Date</td>
                      <td>Remaining Days</td>
                      <td>Note</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                </table>
          </div>         
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@if(auth()->user()->hasRole('admin'))
<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
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
                  Are you sure you want to delete this record?
                  <input type="hidden" id="pd_id" name="id">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </div>
          </div>
      </form>
  </div>
</div>
@elseif(auth()->user()->hasRole('user'))
<div class="modal fade" id="reportModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="reportModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <form action="{{ url('report_issue') }}" method="post" id="report_form" method="post">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Report Issue with account</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>Explain in detail any issue</p>
                  <input type="hidden" id="pd_id2" name="pd_id" value=""/>
                  <textarea class="form-control" required name="report" placeholder="Enter any issue here"></textarea>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Report</button>
                  <i class="spinner-border text-info spinner-border-sm" style="display:none" id="loader"></i>
                  <button type="button" class="btn bg-secondary text-white" data-dismiss="modal">Close</button>
              </div>
          </div>
      </form>
  </div>
</div>
@endif
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/form-tooltip-valid.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/prism.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/init.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $('#start_date').pickadate({
            format:'dd/mm/yyyy'
        });
        $('#end_date').pickadate({
            format:'dd/mm/yyyy'
        });
    var mainTable = $('#report_table').DataTable();
    $('body').on('#deleteModal show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var pd_id = button.data('id'); 
            var action = button.data('route');
            var modal = $(this);
            $('#delete_form').attr("action","{{ url('purchase/delete_record')}}");
            modal.find('.modal-body #pd_id').val(pd_id);
        }); 
    $('body').on('#reportModal show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var pd_id = button.data('id'); 
            var modal = $(this);
            modal.find('.modal-body #pd_id2').val(pd_id);
        }); 
    $('#report').submit(function(e) {
        e.preventDefault();
        var form_data=$('#report').serialize();
        /*$.ajax({
          url:"{{url('report/get_purchase_report')}}",
          data:{
            '_token':'{{csrf_token()}}',
            'start_date':$('#start_date').val()
          },
          type:'post',
          dataType:'json',
          success:function(data) {
            mainTable .clear().draw();
            //mainTable .rows.add(data).draw();
            data = JSON.parse(data.aaData);
            mainTable.rows.add(data.aaData).draw();
          }
        });*/
        mainTable.destroy();
        mainTable=$('#report_table').DataTable({
         processing: true,
         serverSide: true,
         pageLength:10,
         ajax: {
             url:"{{url('report/get_purchase_report')}}",
             data:{
               '_token':'{{csrf_token()}}',
               'start_date':$('#start_date').val(),
               'end_date':$('#end_date').val(),
               'user_id':$('#user_id').val(),
             },
             type:'post',
             dataType:'json'
         },
         columns: [
            { data: 'pd_id' },
            { data: 'name' },
            { data: 'username' },
            { data: 'password' },
            { data: 'start_date' },
            { data: 'end_date' },
            { data: 'remaining_days' },
            { data: 'note' },
            { data: 'action' },
         ]
      });
    });
    //$('#report').trigger('submit');
  });
</script>
@endsection