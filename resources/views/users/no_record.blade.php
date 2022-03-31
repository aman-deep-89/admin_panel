@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Modify Purchase Detail')

{{-- vendor style --}}
@section('vendor-styles')
@endsection
{{-- page-styles --}}

@section('content')
<div class="row">
    
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Modify Purchase Detail</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
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
                            <div class="alert alert-warning">You can't edit this information</div>
                    </div>
                </div>
            </div>
        </div>
         </div>
</section>
@endsection
{{-- vendor scripts --}}