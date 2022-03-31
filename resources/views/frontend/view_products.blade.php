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
        <?php
        $images=[];
        if($item->photos) $images=json_decode($item->photos,true);
        ?> 
        <div class="col-xl-4 col-md-4 col-12">
                <a href="javascript:void(0)"  @if(!$item->out_of_stock) 
                    data-toggle="modal" data-target="#productModal" 
                    @endif data-id="{{$item->id}}" data-pd_name="{{$item->name}}" data-image="<?php echo isset($images[0]) ? $images[0] : ''; ?>" data-desc="{{$item->description}}" data-price="{{$item->price}}" data-stock="{{ $item->closing_stock }}">           
                <div class="card">
                    @if($item->out_of_stock) 
                        <div class="overlay"><div>Out of Stock</div></div>
                    @endif
                <div class="card-content">
                    <div class="row no-gutters">
                    <div class="col-12 d-flex align-items-stretch justify-content-center p-1">
                        <?php if(sizeof($images)) {
                            ?>
                            @foreach ($images as $key=>$img)
                                <img class="img-fluid img-thumbnail" style="height:200px" src="{{ getenv('APP_URL').Storage::url('app/public/'.$img)}}" alt="<?= $img ?>">
                                @php
                                    break;
                                @endphp
                            @endforeach
                        <?php } ?>
                    </div>
                    <div class="col-12">
                        <div class="card-body text-center">
                        <h4 class="card-title">{{$item->sku}}</h4>
                        <div class="row">
                            <div class="col-12">
                                <p class="card-text badge badge-info">Price &nbsp;{{ getenv('CURRENCY') }}{{$item->price}}</p>
                            </div>                            
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </a>           
          </div> 
        @endforeach
    </div>
</section>
<!-- Basic Inputs end -->

<div class="modal fade" id="productModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="#" method="post" id="buy_form" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pd_name"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="product_id" value="" name="id" />
                            Price
                            <input type="text" id="price" class="form-control" readonly/>
                            Quantity
                            <select name="quantity" id="quantity" class="form-control">
                                <?php 
                                    for($i=1;$i<6;$i++) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <img id="src_img" src="" class="img-fluid" />
                            <p id="desc"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Buy</button>
                    <i class="spinner-border text-info spinner-border-sm" style="display:none" id="loader"></i>
                    <button type="button" class="btn bg-secondary text-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
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
    $('#productModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var pd_id = button.data('id'); 
            var pd_name = button.data('pd_name'); 
            var image = button.data('image'); 
            var desc = button.data('desc'); 
            var price = button.data('price'); 
            var stock = button.data('stock'); 
            console.log("pd_id"+pd_id);
            var modal = $(this);
            modal.find('.modal-body #product_id').val(pd_id);
            modal.find('.modal-header #pd_name').text(pd_name);
            modal.find('.modal-body #available_stock').val(stock);
            modal.find('.modal-body #price').val(price);
            modal.find('.modal-body #desc').html(desc);
            var quantity='';
            for(i=1;i<6;i++) {
                quantity+='<option value="'+i+'">'+i+'-> {{getenv('CURRENCY')}} '+(i*price)+'</option>';
            }
            modal.find('.modal-body #quantity').html(quantity);
            modal.find('.modal-body #src_img').attr('src',"{{getenv('APP_URL').Storage::url('app/public/')}}"+image);
        }); 
    $('#buy_form').submit(function(e) {
        e.preventDefault();
        var form_data=$('#buy_form').serialize()
        $.ajax({
            url:'{{ url('buy')}}',
            data:form_data,
            type:'post',
            dataType:'json',
            beforeSend:function() {
                $('#loader').show();
            },
            success:function(res) {
                $('#loader').hide();
                $('#productModal').modal('hide');
                if(res.success) {
                    Swal.fire({
                        type: 'success',
                        title: 'Congratulations',
                        text:'You will receive its credentials on your email {{ auth()->user()->email }} ',showConfirmButton: true,
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