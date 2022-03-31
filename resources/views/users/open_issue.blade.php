@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Open Issue Detail')

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
                    <h4 class="card-title">Issue Detail</h4>
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
                        <div class="row">
                            <div class="col-3"> User name </div>
                            <div class="col-3"> {{$detail->purchase_detail->purchases->users->username}} ({{$detail->purchase_detail->purchases->users->email}}) </div>
                            <div class="col-3"> Product </div>
                            <div class="col-3"> {{$detail->purchase_detail->purchases->products->name}} </div>
                            <div class="col-3"> Total Accounts </div>
                            <div class="col-3"> {{$detail->purchase_detail->pd_quantity}} </div>
                            <div class="col-3"> Price </div>
                            <div class="col-3"> {{$detail->purchase_detail->pd_price}} </div>
                        </div>
                            <div class="mt-1 pt-2 border-top">
                                <div class="row d-flex">
                                    <div class="col-md-2"><strong>Email/Username-Password</strong></div>
                                    <div class="col-md-3"><strong>Start Date/End Date</strong></div>
                                    <div class="col-md-2"><strong>Status</strong></div>
                                    <div class="col-md-2"><strong>Issue Reported</strong></div>
                                    <div class="col-md-2"><strong>Issue Status</strong></div>
                                </div>
                                    <div class="row d-flex mt-1">
                                            <div class="col-md-2">{{$detail->purchase_detail->pd_username}}-{{$detail->purchase_detail->pd_password}}</div>
                                            <div class="col-md-3">{{$detail->purchase_detail->pd_start_date }} to {{$detail->purchase_detail->pd_end_date }}</div>
                                            <div class="col-md-2">{{$detail->purchase_detail->pd_status }}</div>
                                            <div class="col-md-2">{{$detail->detail }} On <br/> {{ $detail->created_at->format('d-m-Y h:i A')}}</div>
                                            <div class="col-md-2">{{$detail->issue_status }} <br/> {{ $detail->status_description }}</div>
                                        </div>
                        </div>
                        @if(auth()->user()->hasRole('admin') && $detail->issue_status=='pending') 
                        <form action="{{ url('update_issue_status') }}" method="post">
                            @csrf
                            <input type="hidden" name="issue_id" value="{{ $detail->id }}" />
                            <div class="row">
                                <div class="col-6">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Enter Description</label>
                                <textarea class="form-control" name="description" value="{{ old('decsription') }}"></textarea>
                            </div>
                            </div>
                        
                        <div class="row mt-3">                           
                            <div class="col-12 text-center text-danger" id="error"></div>
                            <div class="col-12 text-center"> 
                            @if($detail->issue_status=='pending') 
                                <button type="submit" class="btn btn-primary">Update</button>
                            @endif
                                <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                <a href="{{ url('view_issues') }}" name="btn" class="btn btn-secondary">Back</a>
                            </div>
                    </div>
                </form>
                        @else                                                
                        <div class="row mt-3">                           
                                <div class="col-12 text-center text-danger" id="error"></div>
                                <div class="col-12 text-center"> 
                                    <button type="button" id="loader" style="display:none" class="spinner-border text-info"></button>
                                    <a href="{{ url('view_issues') }}" name="btn" class="btn btn-secondary">Back</a>
                                </div>
                        </div>
                        @endif
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