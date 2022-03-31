@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','View Note')
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/js/pickers/datetime/jquery.datetimepicker.min.css')}}">    
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-email.css')}}">    
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">        
  <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">      
@endsection
@section('content')
<!-- Basic Inputs start -->
<section class="email-app-list-wrapper">
  <div class="row email-app-list">
      <!-- invoice view page -->
      <div class="col-xl-9 col-md-8 col-12">
          <div class="card invoice-print-area">
              <div class="card-content">
                  <div class="card-body pb-0 mx-25">
                      <div class="row invoice-info">
                          <div class="col-6 mt-1">
                              <h6 class="invoice-from">Date</h6>
                              <div class="mb-1">
                                  <span>{{ $notes->creation_time->format('d/m/Y h:i A') }}</span>
                              </div>
                          </div>
                          <div class="col-3 mt-1">
                              <h6 class="invoice-to">Name</h6>
                              <div class="mb-1">
                                  <span>{{$notes->name}}</span>
                              </div>
                          </div>
                          <div class="col-3 mt-1">
                              <h6 class="invoice-to">Tag</h6>
                              <div class="mb-1">
                                  <span>{{$notes->tags}}</span>
                              </div>
                          </div>
                          <div class="col-6 mt-1">
                              <h6 class="invoice-from">Contact No</h6>
                              <div class="mb-1">
                                  <span>{{ $notes->contact_no }}</span>
                              </div>
                          </div>
                          <div class="col-3 mt-1">
                              <h6 class="invoice-to">Created By</h6>
                              <div class="mb-1">
                                  <span>{{$notes->create->name}}</span>
                              </div>
                          </div>
                          <div class="col-3 mt-1">
                              <h6 class="invoice-to">Assigned To</h6>
                              <div class="mb-1">
                                  <span>{{$notes->assign->name}}</span>
                              </div>
                          </div>
                          <div class="col-6 mt-1">
                              <h6 class="invoice-from">Ticket No</h6>
                              <div class="mb-1">
                                  <span>{{ $notes->ticket_number }}</span>
                              </div>
                          </div>
                          <div class="col-3 mt-1">
                              <h6 class="invoice-to">Amount</h6>
                              <div class="mb-1">
                                  <span>{{$notes->amount}}</span>
                              </div>
                          </div>
                          <div class="col-3 mt-1">
                              <h6 class="invoice-to">Remaining Amount</h6>
                              <div class="mb-1">
                                  <span>{{$notes->remaining_amount}}</span>
                              </div>
                          </div>
                          {{$remarks=null}}
                          @if(!empty($notes->other_data))
                            <?php                            
                            $data=json_decode($notes->other_data,true);   ?>
                            @foreach($data as $key=>$d) 
                            @if($key=='remarks')
                              <?php $remarks=$d; ?>
                            @endif
                            <div class="col-3 mt-1">
                              <h6 class="invoice-to">{{ucfirst($key)}}</h6>
                              <div class="mb-1">
                                  <span>{{$d}}</span>
                              </div>
                          </div>
                          @endforeach
                          @endif
                          <div class="col-12 mt-1">
                              <h6 class="invoice-to">Notes</h6>
                              <div class="mb-1">
                                  <span>{{$notes->note}}</span>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="history-tab" data-toggle="tab" href="#history" aria-controls="history" role="tab" aria-selected="true">
                                <i class="bx bx-clock align-middle"></i>
                                <span class="align-middle">History</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment_detail-tab" data-toggle="tab" href="#payment_detail" aria-controls="payment_detail" role="tab" aria-selected="false">
                                <i class="bx bx-dollar align-middle"></i>
                                <span class="align-middle">Payment Detail</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="history" aria-labelledby="history-tab" role="tabpanel">                            
                          <div class="email-app-list table-responsive mx-md-25">
                            <div class="email-user-list list-group">
                              <ul class="users-list-wrapper media-list">
                                @foreach($note_status as $ns)  
                                  <li class="media mail-read">
                                      <div class="pr-50">
                                          <div class="avatar">
                                              <img src="{{asset('images/avatar/'.$ns->ns_create->profile_img)}}" alt="avtar img holder">
                                          </div>
                                      </div>
                                      <div class="media-body">
                                          <div class="user-details">
                                              <div class="mail-items">
                                                  <span class="list-group-item-text text-truncate">{{$ns->ns_remarks}} </span>
                                              </div>
                                              <div class="mail-meta-item">
                                                  <span class="float-right">
                                                      <span class="mail-date">{{$ns->creation_time->format('d/m/Y h:i A')}}</span>
                                                  </span>
                                              </div>
                                          </div>
                                          <div class="mail-message">
                                            <p class="list-group-item-text truncate mb-0">
                                                @if($ns->ns_assigned_to!=null)
                                                  Assigned to {{$ns->ns_assign->name}}
                                                  @else 
                                                  Remarks added by  {{$ns->ns_create->name}}
                                                @endif
                                                </p>
                                              <div class="mail-meta-item">
                                                  <span class="float-right">
                                                      <span class="bullet bullet-success bullet-sm"></span>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                                @endforeach
                                </ul>
                              </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="payment_detail" aria-labelledby="payment_detail-tab" role="tabpanel">   
                          <div class="email-app-list table-responsive mx-md-25">
                            <div class="email-user-list list-group">
                              <ul class="users-list-wrapper media-list">
                                @foreach($payment_detail as $pd)  
                                  <li class="media mail-read">
                                      <div class="pr-50">
                                          <div class="avatar">
                                              <img src="{{asset('images/avatar/'.$pd->p_create->profile_img)}}" alt="avtar img holder">
                                          </div>
                                      </div>
                                      <div class="media-body">
                                          <div class="user-details">
                                              <div class="mail-items">
                                                  <span class="list-group-item-text text-truncate"><?php echo Helper::get_currency_symbol() ?> {{$pd->p_amount}} </span>
                                              </div>
                                              <div class="mail-meta-item">
                                                  <span class="float-right">
                                                      <span class="mail-date">{{$pd->creation_time->format('d/m/Y h:i A')}}</span>
                                                  </span>
                                              </div>
                                          </div>
                                          <div class="mail-message">
                                            <p class="list-group-item-text truncate mb-0">
                                                Added by  {{$pd->p_create->name}}
                                                </p>
                                              <div class="mail-meta-item">
                                                  <span class="float-right">
                                                      <span class="bullet bullet-success bullet-sm"></span>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                                @endforeach
                                </ul>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>                 
              </div>
          </div>
      </div>
      <!-- invoice action  -->
      <div class="col-xl-3 col-md-4 col-12">
          <div class="card invoice-action-wrapper shadow-none border">
              <div class="card-body">
                  <div class="invoice-action-btn">
                      <button type="button" data-toggle="modal" data-target="#subNote" data-id="{{$notes->notes_id}}" data-display="assign_to" class="btn btn-primary btn-block invoice-send-btn mb-2">
                          <span>Assign To</span>
                      </button>
                  </div>
                  <div class="invoice-action-btn">
                      <button type="button" class="btn btn-info btn-block invoice-send-btn mb-2">
                          <span>Update Status</span>
                      </button>
                  </div>
                  <div class="invoice-action-btn mb-2">
                      <button type="button"  data-toggle="modal" data-target="#subNote" data-id="{{$notes->notes_id}}" data-display="sub_note"  class="btn btn-warning btn-block invoice-print">
                          <span>Add Remarks</span>
                      </button>
                  </div>
                  @if(Auth::user()->hasRole('Admin'))
                    <div class="invoice-action-btn mb-2">
                        <button type="button"  data-toggle="modal" data-target="#addTicket" data-id="{{$notes->notes_id}}"  class="btn btn-success btn-block invoice-print">
                            <span>{{ !empty($notes->ticket_number) ? 'Update' : 'Add' }} Ticket Detail</span>
                        </button>
                    </div>                    
                  @endif
                  @if(Auth::user()->can('add-ticket-detail') && empty($notes->ticket_number)) 
                    <div class="invoice-action-btn mb-2">
                        <button type="button"  data-toggle="modal" data-target="#addTicket" data-id="{{$notes->notes_id}}"  class="btn btn-success btn-block invoice-print">
                            <span>Add Ticket Detail</span>
                        </button>
                    </div>
                  @endif
                  @if(Auth::user()->can('update-ticket-detail') && !empty($notes->ticket_number)) 
                    <div class="invoice-action-btn mb-2">
                        <button type="button"  data-toggle="modal" data-target="#addTicket" data-id="{{$notes->notes_id}}"  class="btn btn-success btn-block invoice-print">
                            <span>Update Ticket Detail</span>
                        </button>
                    </div>
                  @endif
                  @if(Auth::user()->hasRole('Admin') || Auth::user()->can('add-payment')) 
                  <div class="invoice-action-btn">
                      <button type="button"  data-toggle="modal" data-target="#addPayment" data-id="{{$notes->notes_id}}"  class="btn btn-success btn-block invoice-print">
                          <span>Add Payment Detail</span>
                      </button>
                  </div> 
                  @endif                 
              </div>
          </div>
      </div>
  </div>
</section>
<div class="modal fade" id="subNote" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="subNote" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
      <form action="{{ url('notes/save_sub_note') }}" method="post" id="sub_note_form">
          @method('POST')
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Create Sub Note</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body"> 
                  <div id="sub_note_error" class="text-danger"></div>                   
                  <input type="hidden" id="note_id" name="note_id">
                  <input type="hidden" id="type" name="type">
                  <label for="date">Date *</label>
                  {!! Form::input('text','date',date('Y/m/d H:i'), ['class' => 'form-control','id'=>'datetime']) !!}  
                  <div class="row fields" id="assign_to">
                    <div class="col-md-12">                  
                      <label for="assign_to">Assign To <small>leave it blank to keep it as it is</small></label>
                      {!! Form::select('assign_to', $users, null, ['class' => 'form-control chosen-select']) !!}
                    </div>
                  </div>
                  <div class="row fields" id="sub_note">
                    <div class="col-md-12">
                      <label for="sub_note">Enter sub note*</label>
                      <textarea name="sub_note" class="form-control"></textarea>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <span id="loader" class="btn btn-info" style="display:none"><i class="bx bx-loader bx-spin"></i></span>
                  <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
              </div>
          </div>
      </form>
  </div>
</div>
<!-- ticket detail model -->
<div class="modal fade" id="addTicket" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ticket_detail" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
      <form action="{{ url('notes/save_ticket_detail') }}" method="post" class="needs-validation" novalidate id="ticket_detail_form">
          @method('POST')
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Ticket Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body"> 
                  <div id="ticket_detail_error" class="text-danger"></div>                   
                  <input type="hidden" id="t_note_id" name="note_id">
                  <div class="row fields" id="assign_to">
                    <div class="col-md-12">
                      <label for="ticket_number">Ticket number</label>
                      {!! Form::input('text','ticket_number', $notes->ticket_number, ['class' => 'form-control required','required data-validation-required-message="This name field is required"']) !!}
                    </div>
                  </div>
                  <div class="row fields" id="assign_to">
                    <div class="col-md-12">
                      <label for="amount">Amount</label>
                      {!! Form::input('text','amount', $notes->amount, ['class' => 'form-control required','required data-validation-regex-regex="^([0-9]+)$" data-validation-required-message="Please enter valid amount"']) !!}
                    </div>
                  </div>
                  <div class="row fields" id="remarks">
                    <div class="col-md-12">
                      <label for="remarks">Enter remarks</label>
                      <textarea name="remarks" class="form-control allcaps">{{$remarks}}</textarea>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <span id="loader2" class="btn btn-info" style="display:none"><i class="bx bx-loader bx-spin"></i></span>
                  <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
              </div>
          </div>
      </form>
  </div>
</div>
<!-- payment detail model -->
<div class="modal fade" id="addPayment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ticket_payment_detail" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
      <form action="{{ url('notes/save_payment_detail') }}" method="post" class="needs-validation" novalidate id="ticket_payment_form">
          @method('POST')
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Payment Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body"> 
                  <div id="payment_detail_error" class="text-danger"></div>                   
                  <input type="hidden" id="p_note_id" name="note_id" value="{{$notes->notes_id}}">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="date">Date *</label>
                  {!! Form::input('text','date',date('Y/m/d H:i'), ['class' => 'form-control','id'=>'datetime2']) !!}  
                      <label for="amount">Amount</label>
                      {!! Form::input('text','amount', $notes->remaining_amount, ['class' => 'form-control required','required data-validation-regex-regex="^([0-9]+)$" data-validation-required-message="Please enter valid amount"']) !!}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="payment_mode">Payment Mode</label>
                      {!! Form::select('payment_mode', Helper::get_payment_mode(),'Cash', ['class' => 'form-control required chosen-select','required data-validation-required-message="Please enter valid payment_mode"']) !!}
                    </div>
                    <div class="col-md-12">
                      <label for="payment_detail">Payment Detail <small>(cash register no, card no etc)</small></label>
                      {!! Form::input('text','payment_detail','', ['class' => 'form-control required','required data-validation-required-message="Please enter valid payment_detail"']) !!}
                    </div>
                  </div>
                  <div class="row fields" id="remarks">
                    <div class="col-md-12">
                      <label for="remarks">Enter remarks</label>
                      <textarea name="remarks" class="form-control allcaps"></textarea>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <span id="loader3" class="btn btn-info" style="display:none"><i class="bx bx-loader bx-spin"></i></span>
                  <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
              </div>
          </div>
      </form>
  </div>
</div>
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
  $('#datetime,#datetime2').datetimepicker({
    timepicker:true,
    mask:true
  });
  $('#subNote').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var note = button.data('id'); 
      var ele = button.data('display');
      $('#sub_note_error').html("");
      $('#sub_note_form').trigger('reset');
      $('.fields').hide();
      $('#'+ele).show();
      $('#type').val(ele);
      var modal = $(this);
      modal.find('.modal-body #note_id').val(note);
  });
  $('#sub_note_form').submit(function(e) {
      e.preventDefault();
      var fdata=$(this).serialize();
      $.ajax({
          url:"{{url('notes/save_sub_note')}}",
          data:fdata,
          type:'POST',
          dataType:'json',
          beforeSend: function() {
            $('#loader').show();
          },
          success:function(res) {
              $('#loader').hide();
              if(res.success)  {
                  location.reload();
              }else {
                  for(i=0;i<res.length;i++)
                      $('#sub_note_error').html(res[i]+'<br/>');
              }
        }
    });
  });
  $('#addTicket').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var note = button.data('id'); 
      $('#ticket_detail_error').html("");
      $('#ticket_detail_form').trigger('reset');
      var modal = $(this);
      modal.find('.modal-body #t_note_id').val(note);
  });
  $('#ticket_detail_form').submit(function(e) {
      e.preventDefault();
      var fdata=$(this).serialize();      
      $.ajax({
          url:"{{url('notes/save_ticket_detail')}}",
          data:fdata,
          type:'POST',
          dataType:'json',
          beforeSend: function() {
            $('#loader2').show();
          },
          success:function(res) {
              $('#loader2').hide();
              if(res.success)  {
                  location.reload();
              }else {
                  for(i=0;i<res.length;i++)
                      $('#ticket_detail_error').append(res[i]+'<br/>');
              }
        }
    });
  });
  $('#addpayment').on('show.bs.modal', function (event) {
      alert();
      var button = $(event.relatedTarget);
      var note = button.data('id'); 
      console.log("id="+note);
      $('#payment_detail_error').html("");
      $('#ticket_payment_form').trigger('reset');
      var modal = $(this);
      modal.find('.modal-body #p_note_id').val(note);
  });
  $('#ticket_payment_form').submit(function(e) {
      e.preventDefault();
      var fdata=$(this).serialize();            
      $.ajax({
          url:"{{url('payment/save_payment')}}",
          data:fdata,
          type:'POST',
          dataType:'json',
          beforeSend: function() {
            $('#loader3').show();
            $('#payment_detail_error').html("");
          },
          success:function(res) {
              $('#loader3').hide();
              if(res.success)  {
                  location.reload();
              }else {
                  for(i=0;i<res.length;i++)
                      $('#payment_detail_error').append(res[i]+'<br/>');
              }
        }
    });
  });
});
</script>
@endsection