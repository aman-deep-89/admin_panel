@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Edit Company')

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
                <form action="{{route('department.update',$department->department_id)}}" class="needs-validation" method="post">
                    @method('PATCH')
                    @csrf
                <fieldset class="form-group">
                  <label for="dep_name">Department Name *</label>
                  <input type="text" class="form-control" id="dep_name" name="dep_name"  placeholder="Enter name" value="{{ old('dep_name',$department->dep_name) }}">
                </fieldset>

                <fieldset class="form-group">
                  <label for="dep_desc">Description</label>
                  <small class="text-muted"><i>optional</i></small>
                  <input type="text" class="form-control" id="dep_desc" name="dep_description" value="{{ old('dep_desription',$department->dep_description) }}">
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
<!-- Basic Inputs end -->


@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/form-tooltip-valid.js')}}"></script>
@endsection