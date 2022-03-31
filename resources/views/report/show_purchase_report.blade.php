@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','PurchaseReport')
@section('page-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
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
                <form action="{{url('report/show_purchase_report') }}" class="needs-validation" method="post" id="report">
                    @csrf
                <fieldset class="form-group row">
                  <div class="col-6">
                    <label for="start_date">From Date <small>Leave it blank to show all records</small></label>
                    <input type="text" class="form-control" id="start_date" name="start_date"  placeholder="From" value="{{ old('start_date') }}">
                  </div>
                  <div class="col-6">
                      <label for="end_date">End Date <small>Leave it blank to show all records</small></label>
                      <input type="text" class="form-control" id="end_date" name="end_date"  placeholder="Untill" value="{{ old('end_date') }}">
                  </div>
                </fieldset>
                <fieldset class="form-group row">
                  <div class="col-6">
                    <label for="user_id">Users</label>
                    {!! Form::select('user_id[]', $users, $user_id, ['class' => 'form-control chosen-select','multiple'=>'multiple']) !!}
                  </div>
                  <div class="col-6">
                    <br/>
                    <button class="btn btn-primary" type="submit">Show Report</button>
                  </div>
                </fieldset>                
            </form>
            </div>
            <div class="col-12">
                <table id='report_table' width='100%' class="table">
                    <thead>
                      <tr>
                        <td>S.no</td>
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
<script type="text/javascript">
    $(function() {
        //var form_data=;
        //console.log(form_data);
        $('#report_table').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
             url:"{{url('report/get_purchase_report')}}",
             data:$('#report').serializeArray(),
             type:'post',
             dataType:'json'
         },
         columns: [
            { data: 'id' },
            { data: 'username' },
            { data: 'name' },
            { data: 'email' },
         ]
      });
    });
</script>
@endsection