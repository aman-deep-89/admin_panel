@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Add Company')
@section('page-styles')
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
                <form action="{{route('role.store') }}" class="needs-validation" method="post">
                    @csrf
                <fieldset class="form-group">
                  <label for="role_name">Role Name *</label>
                  <input type="text" class="form-control" id="role_name" name="role_name"  placeholder="Enter name" value="{{ old('role_name') }}">
                </fieldset>
                <fieldset class="form-group">
                  <label for="role_slug">Role slug *</label>
                  <input type="text" class="form-control" id="role_slug" name="role_slug"  placeholder="Enter name" value="{{ old('role_slug') }}">
                </fieldset>
                
                <fieldset class="form-group">
                  <label for="permission_id">Permissions</label>
                  {!! Form::select('permission_id[]', $permissions, 0, ['class' => 'form-control chosen-select','multiple'=>'multiple']) !!}
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
});
</script>
@endsection