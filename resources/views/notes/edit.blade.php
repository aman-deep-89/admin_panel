@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Edit Note')
@section('page-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/js/pickers/datetime/jquery.datetimepicker.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">
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
                <form action="{{route('notes.update',$notes->notes_id) }}" class="needs-validation" method="post">
                  @method('PATCH')
                  @csrf
                <fieldset class="form-group">
                  <label for="date">Date *</label>
                  <input type="text" class="form-control" id="datetime" name="date"  placeholder="Enter Date" value="{{ old('date',$notes->creation_time->format('Y/m/d H:i:s')) }}" />
                </fieldset>
                <fieldset class="form-group">
                  <label for="name">Name*</label>
                  <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" value="{{ old('name',$notes->name) }}">
                </fieldset>
                <fieldset class="form-group row">
                  <div class="col-md-9">
                    <label for="assign_to">Assign To*</label>
                    {!! Form::select('assign_to', $users, $notes->assigned_to, ['class' => 'form-control chosen-select']) !!}
                    @error('assign_to')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </fieldset>
                <fieldset class="form-group">
                  <label for="contact_number">Contact Number *</label>
                  <input type="text" class="form-control" id="contact_number" name="contact_number"  placeholder="Enter contact number" value="{{ old('contact_number',$notes->contact_no) }}">
                </fieldset>
                <fieldset class="form-group">
                  <label for="notes">Notes</label>
                  <input type="text" class="form-control" id="notes" name="notes"  placeholder="Enter Notes" value="{{ old('notes',$notes->note) }}">
                </fieldset>
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
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
<script src="{{asset('vendors/js/pickers/datetime/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/prism.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/init.js')}}"></script>
<script type="text/javascript">
$(function() {
  $('#role_name').keyup(function(e) {
    var txt=$(this).val();
    var txt2=txt.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
    $('#role_slug').val(txt2);    
  });
  $('#datetime').datetimepicker({
    timepicker:true,
    mask:true
  });
});
</script>
@endsection