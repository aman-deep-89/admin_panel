@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Open Account Requests')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection
{{-- page-styles --}}

@section('content')
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Requests Detail</h4>
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
                        <form action="" method="post" class="needs-validation" id="save_account">
                            @csrf
                        <div class="row">
                            <div class="col-md-3"> <strong>User name </strong></div>
                            <div class="col-md-3"> {{$detail->users->username}} ({{$detail->users->email}}) </div>
                            <div class="col-md-3"><strong> Product</strong> </div>
                            <div class="col-md-3"> {{$detail->products->name}} </div>
                            <div class="col-md-3"><strong> Total Accounts </strong></div>
                            <div class="col-md-3"> {{$detail->quantity}} </div>
                            <div class="col-md-3"><strong> Price</strong> </div>
                            <div class="col-md-3"> {{$detail->total_price}} </div>
                        </div>
                            <div class="mt-1 pt-2 border-top">
                                <div class="row d-flex">
                                    <div class="col-md-2"><strong>Email/Username</strong></div>
                                    <div class="col-md-2"><strong>Password</strong></div>
                                    <div class="col-md-3"><strong>Start Date</strong></div>
                                    <div class="col-md-3"><strong>End Date</strong></div>
                                    <div class="col-md-2"><strong>Days Remaining/Cost</strong></div>                                    
                                </div>
                                    @foreach ($detail->purchase_detail as $key=>$item)                                   
                                        <div class="row d-flex mt-1">
                                            <div class="col-md-2">{{$item->pd_username}}</div>
                                            <div class="col-md-2">{{$item->pd_password}}</div>
                                            <div class="col-md-3">{{$item->pd_start_date }}</div>
                                            <div class="col-md-3">{{$item->pd_end_date }}</div>
                                            <div class="col-md-2">{{$item->pd_status }}</div>
                                        </div> 
                                    @endforeach
                        </div>
                        <div class="row mt-3">
                                <div class="col-12 text-center text-danger" id="error"></div>
                                <div class="col-12 text-center">
                                    <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                    <a href="{{ url('view_purchases') }}" name="btn" class="btn btn-secondary">Back</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/form-tooltip-valid.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
    <script tyle="text/javascript">    
    </script>
@endsection