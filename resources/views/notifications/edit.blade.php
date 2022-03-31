@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Edit Notification')
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
                <form action="{{route('notification.update',$notification->notification_id) }}" class="needs-validation" method="post">
                    @csrf
                    @method('PATCH')
                <fieldset class="form-group">
                  <label for="title">Title*</label>
                  <input type="text" class="form-control" id="title" name="title" required placeholder="Enter name" value="{{ old('title',$notification->notification_title) }}">
                </fieldset>
                <fieldset class="form-group">
                  <label for="description">Description <small>Optional</small></label>
                  <input type="text" class="form-control" id="description" name="description"  placeholder="Enter name" value="{{ old('description',$notification->notification_text) }}">
                </fieldset>
                <fieldset class="form-group">
                  <label for="active">Active</label><br/>
                  <input type="radio" id="active1" name="active" value="1" @if ($notification->n_enable==1)
                      checked
                  @endif> Yes
                  <input type="radio" id="active0" name="active" value="0" @if ($notification->n_enable==0)
                      checked
                  @endif> No
                </fieldset>
                
                <fieldset class="form-group">
                  <label for="user_id">Users <small>Leave it blank to show for all users</small></label>
                  <?php
                    $user_ids=$notification->user_id!=null ? explode(',',$notification->user_id) : array();
                  ?>
                  {!! Form::select('user_id[]', $users, $user_ids, ['class' => 'form-control required chosen-select','multiple'=>'multiple']) !!}
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