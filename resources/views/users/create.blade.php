@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Add User')
@section('page-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/js/imgpicker/imgpicker.css')}}">
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
                <form action="{{route('user.store') }}" class="needs-validation" method="post">
                <div class="row">
                  <div class="col-md-8">               
                        @csrf
                    <fieldset class="form-group">
                      <label for="username">User Name * <small>must be unique contains alphanumeric chars</small></label>
                      <input type="text" class="form-control username @error('email') is-invalid @enderror" id="username" name="username"  required placeholder="Enter username" value="{{ old('username') }}">
                      <div id="username_error" class="text-danger"></div>
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="first_name">User First Name *</label>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" id="first_name" name="first_name"  required placeholder="Enter first_name" value="{{ old('first_name') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="last_name">User Last Name *</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" required  placeholder="Enter last_name" value="{{ old('last_name') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="phone_no">Phone no *</label>
                      <input type="text" class="form-control" id="phone_no" name="phone_no" required  placeholder="Enter Phone No" value="{{ old('phone_no') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="alternate_phone_no">Alternate Phone no <small>(optional)</small></label>
                      <input type="text" class="form-control" id="alternate_phone_no" name="alternate_phone_no"  placeholder="Enter Alternate Phone number" value="{{ old('alternate_phone_no') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="internal_data">Internal Data *</label>
                      <input type="text" class="form-control" id="internal_data" name="internal_data" required placeholder="Enter Internal data" value="{{ old('internal_data') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="initial_balance">Initial Balance *</label>
                      <input type="text" class="form-control" id="initial_balance" name="initial_balance" required placeholder="Enter initial_balance" value="{{ old('initial_balance') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="vendor">Vendor *</label>
                      <input type="text" class="form-control" id="vendor" name="vendor" required placeholder="Enter Vendor" value="{{ old('vendor') }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="business_type">Business Type *</label>
                      <input type="text" class="form-control" id="business_type" name="business_type" required placeholder="Enter business type" value="{{ old('business_type') }}">
                    </fieldset>
                    <div class="form-group mb-50">
                      <label class="text-bold-600" for="email">Email address <small>(must be unique)</small></label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group mb-2">
                      <label class="text-bold-600" for="password">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mb-2">
                      <label class="text-bold-600" for="password-confirm">Confirm Password</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>
                    
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                  <div class="col-md-4">
                    <label>Logo</label>
                    <input type="hidden" name="logo" id="image_name" value="" />
                    <div class="image-wrapper" style="height:220px;">
                      <img src="{{asset('images/logo/logo.png')}}" class="avatar image1" width="200px" height="200px">
                      <button type="button" class="edit-avatar btn btn-info">Edit</button>
                    </div>
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
<script type="text/javascript">
$(function() {
  $('#username').keyup(function(e) {
    var txt=$(this).val();
    $.ajax({
      url:"{{ url('user/check_username') }}",
      data:"name="+txt+"&id=0&_token={{ csrf_token() }}",
      type:'post',
      dataType:'json',
      beforeSend:function() {
        $('#username_error').html("");
      },
      success:function(res) {
        if(res.error) $('#username_error').html(res.error);
      }
    });
  });
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
});
</script>
@endsection