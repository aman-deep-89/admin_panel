@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Edit Permission')

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
                <form action="{{route('permission.update',$permission->id)}}" class="needs-validation" method="post">
                    @method('PATCH')
                    @csrf
                <fieldset class="form-group">
                  <label for="permission_name">Name *</label>
                  <input type="text" class="form-control" id="permission_name" name="permission_name"  placeholder="Enter name" value="{{ old('permission_name',$permission->name) }}">
                </fieldset>

                <fieldset class="form-group">
                  <label for="permission_slug">slug*</label>
                  <small class="text-muted"><i>optional</i></small>
                  <input type="text" class="form-control" id="permission_slug" name="permission_slug" value="{{ old('permission_slug',$permission->slug) }}">
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
<script type="text/javascript">
  $(function() {
    $('#permission_name').keyup(function(e) {
      var txt=$(this).val();
      var txt2=txt.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
      $('#permission_slug').val(txt2);
    });
  });
  </script>
@endsection