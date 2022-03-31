@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Edit Balance')
@section('page-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/js/imgpicker/imgpicker.css')}}">
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
                <form action="{{url('user/edit_balance') }}" class="needs-validation" method="post">
                <div class="row">
                  <div class="col-md-8">               
                        @csrf                        
                    <fieldset class="form-group">
                      <label for="first_name">User</label>
                      <input type="hidden" name="bh_id" value="{{ $list->bh_id }}" >
                      {!! Form::select('user_id', $users, $list->user_id, ['class' => 'form-control required chosen-select']) !!}
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="balance_amount">Balance Amount</label>
                      <input type="number" min="1" step="0.01" class="form-control" id="balance_amount" name="balance_amount" required  placeholder="Enter Amount" value="{{ old('balance_amount',$list->amount) }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="date">Date</label>
                      <input type="text" class="form-control" id="date" name="date" required  placeholder="Enter Date" value="{{ old('date',date('d/m/Y',strtotime($list->date))) }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="description">Description <small>optional</small></label>
                      <textarea class="form-control" id="description" name="description" required  placeholder="Enter description">{{ old('description',$list->bh_description) }}</textarea>
                    </fieldset>
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>                  
                </div>
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
<script src="{{asset('js/scripts/chosen/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/prism.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/init.js')}}"></script>
<script src="{{asset('vendors/js/imgpicker/imgpicker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script type="text/javascript">
$(function() {  
  $('.edit-avatar').imgPicker({
    el: '.avatar',
    type: 'avatar',  
    width:500,  
    minWidth: 100,
    minHeight: 100,
    title: 'Change your Logo',
    aspectRatio:'3:2',
    dataEl : 'image_name',
    _token: "{{ csrf_token() }}",
	  api: '{{ url('upload_image') }}',
	});
	 $('.ip-save').click( function(){   
            net();
    });
    $('#date').pickadate({
        format:'dd/mm/yyyy'
    });
});
</script>
@endsection