@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','View Products')
@section('page-styles')
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('js/scripts/chosen/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/js/imgpicker/imgpicker.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
@endsection
@section('content')
<!-- Basic Inputs start -->
<section id="basic-input">
    <div class="row">        
        @foreach ($products as $item)               
            <div class="col-xl-6 col-md-6 col-12">
                <div class="card">                    
                <div class="card-content">
                    <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 d-flex align-items-stretch justify-content-center p-1">
                        <div id="carousel-{{$item->id}}" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                            <?php if($item->photos) { 
                                $images=json_decode($item->photos,true);
                                ?>
                            <ol class="carousel-indicators">
                                @foreach ($images as $key=>$img)
                                    <li data-target="#carousel-{{ $item->id }}" data-slide-to="{{ $key }}" class="<?php if($key==0) echo 'active' ?>"></li>      
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach ($images as $key=>$img)
                                    <div class="carousel-item <?php if($key==0) echo 'active' ?>">
                                        <img class="img-fluid" src="{{ getenv('APP_URL').Storage::url('app/public/'.$img)}}" alt="<?= $img ?>">
                                    </div>
                                @endforeach                              
                            </div>
                            <a class="carousel-control-prev" href="#carousel-{{ $item->id }}" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-{{ $item->id }}" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                            <?php } ?>
                          </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card-body text-center">
                        <h4 class="card-title">{{$item->sku}}</h4>
                        <h4 class="card-title">{{ $item->name}}</h4>
                        <p class="card-text">{{$item->description}}</p>
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text badge badge-info">{{ getenv('CURRENCY') }} {{$item->price}}</p>
                            </div>
                            <div class="col-6">
                                <p class="card-text badge badge-secondary"> {{$item->closing_stock}} Available</p>
                            </div>
                            <div class="col-6 mt-1">                                
                                <input type="number" min="1" max="100" id="quantity{{$item->id}}" class="form-control touchspin" value="1" placeholder='Quantity'>
                            </div>
                            <div class="col-6 mt-1">
                                <a class="btn btn-primary white buy" data-id="{{ $item->id }}">Buy</a>
                                <i class="spinner-border text-info spinner-border-sm" style="display:none" id="loader{{  $item->id }}"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
          </div>            
        @endforeach
    </div>
</section>
<!-- Basic Inputs end -->


@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/form-tooltip-valid.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/prism.js')}}"></script>
<script src="{{asset('js/scripts/chosen/js/init.js')}}"></script>
<script src="{{asset('vendors/js/imgpicker/imgpicker.js')}}"></script>
<script src="{{asset('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
<script type="text/javascript">
$(function() {
    $(".touchspin").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        min: 1,
        max:100
    });
    $('.deleteDep').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var note = button.data('id'); 
            var action = button.data('route');
            var modal = $(this);
            $('#delete_form').attr("action",action);
            modal.find('.modal-body #note').val(note);
        }); 
    $('.buy').click(function(e) {
        e.preventDefault();
        var id=$(this).data("id");
        var quantity=$("#quantity"+id).val();
        $.ajax({
            url:'{{ url('buy')}}',
            data:'id='+id+'&quantity='+quantity+'&_token={{ csrf_token() }}',
            type:'post',
            dataType:'json',
            beforeSend:function() {
                $('#loader'+id).show();
            },
            success:function(res) {
                $('#loader'+id).hide();
                if(res.success) {
                    Swal.fire({
                        type: 'success',
                        title: 'Congratulations, You will receive its credentials on your email {{ auth()->user()->email }} ',
                        showConfirmButton: true,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    }).then(function (result) {
                        location.reload();
                    });
                }
                else if(res.errors) {
                    var str='';                
                    $.each(res.errors,function(index,item) {
                        str+=item;
                    });
                    Swal.fire({
                        title: "Error!",
                        text: str,
                        type: "error",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    });
                }
            }
        });
    });
});
</script>
@endsection