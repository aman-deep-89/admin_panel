@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('page-styles')
    <link href="{{ asset('vendors/plugins/font_awesome/css/all.css') }} " media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/plugins/fileinput/css/fileinput.css') }} " media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/plugins/fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/plugins/fileinput/css/jquery-confirm.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection
@section('vendor-style')
    
@endsection
@section('title','Add Product')

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
                <form action="{{route('product.store') }}" class="needs-validation" method="post">
                    @csrf
                <fieldset class="form-group">
                  <label for="product_name">Product Name *</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" required  placeholder="Enter Product name" value="{{ old('product_name') }}">
                </fieldset>

                <fieldset class="form-group">
                  <label for="product_desc">Description</label>
                  <small class="text-muted"><i>optional</i></small>
                  <input type="text" class="form-control" id="product_desc" name="product_description" value="{{ old('product_description') }}" />
                </fieldset>
                <fieldset class="form-group">
                  <label for="sku">SKU</label>
                  <input type="text" class="form-control" id="sku" name="sku" required value="{{ old('sku') }}" />
                </fieldset>
                <fieldset class="form-group">
                  <label for="price">Price</label>
                  <input type="number" step="0.01" class="form-control" id="price" name="price" required value="{{ old('price') }}" />
                </fieldset>
                <fieldset class="form-group">
                  <label for="p_enable">Active</label><br/>
                  <input type="radio" id="p_enable_yes" name="p_enable" value="1" checked /> Yes
                  <input type="radio" id="p_enable_no" name="p_enable" value="0" /> No
                </fieldset>
                <fieldset class="form-group">
                  <label for="out_of_stock">Out of Stock</label><br/>
                  <input type="radio" id="out_of_stock_yes" name="out_of_stock" value="1"  /> Yes
                  <input type="radio" id="out_of_stock_no" name="out_of_stock" value="0" checked /> No
                </fieldset>
                <fieldset class="form-group">
                  <label for="formFileMultiple" class="form-label">Image</label>
                  <div class="file-loading">
                    <input id="images" type="file" accept="image/*">                    
                </div>
                </div>
                <input type="hidden" id="filenames" name="filenames"  value="{{ old('filenames')}}" />
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
<?php $files=json_decode(old('filenames'),true); 
?>

@endsection

{{-- page scripts --}}
@section('page-scripts')
    <script src="{{asset('js/scripts/forms/form-tooltip-valid.js')}}"></script>
    <script src="{{ asset('vendors/plugins/font_awesome/js/all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/locales/fr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/jquery-confirm.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/plugins/fileinput/js/piexif.js') }}" type="text/javascript"></script>    
    <script type="text/javascript">
        $(function() {
          jsonObj = []; 
          var krajeeGetCount = function(id) {
              var cnt = $('#images').fileinput('getFilesCount');
              return cnt === 0 ? 'You have no files remaining.' :
                  'You have ' +  cnt + ' file' + (cnt > 1 ? 's' : '') + ' remaining.';
          };
          obj=$('#filenames').val().replace(/[\]\["]/g,"").split(",");
          for(i=0;i<obj.length;i++)
          if(obj[i]!='')  jsonObj.push(obj[i]);
          item= {}
          $ele=$("#images");
          $ele.fileinput({
              theme: 'fas',
              showUpload: true,
              showCaption: false,
              allowedFileExtensions: ['jpg', 'png', 'gif','pdf','jpeg'],
              'uploadUrl':'{{ url('upload_file') }}',
              browseClass: "btn btn-primary btn-lg",
              fileType: "any",
              maxFileSize: 10000,
              maxFileCount: 5,
              maxFilesNum: 5,
              uploadExtraData: {
                '_token': '{{ csrf_token() }}',
              },    
              previewFileIcon: "<i class='fa fa-view'></i>",
              overwriteInitial: false,
              initialPreviewAsData: true,
              initialPreview:[ <?php     
                  if(isset($files) && sizeof($files)) {
                      foreach($files as $f) { echo '"'.getenv('app_url').Storage::url('app/public/'.$f).'",'; 
                      }  } else echo 'null';                         
                  ?> ],
              initialPreviewDownloadUrl: '{{ url('upload_file') }}/{filename}',
              initialPreviewConfig: [
                  <?php     
                   if(isset($files) && sizeof($files)) {
                  foreach($files as $f) { echo '{"type":"';  $ext = pathinfo($f, PATHINFO_EXTENSION);
                      if(in_array($ext,array('jpg','gif','png','jpeg','jpe'))) echo 'image",'; else echo 'pdf",'; echo '"caption":"'.$f.'","url":"dress/delete_file/dress/","key":"'.$f.'"},';
                  } };    
                  ?>
            ],
              /*initialPreviewConfig: [
                  {caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
                  {caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
                  {caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
              ]*/
          }).on("filebatchselected", function(event, files) {
              $ele.fileinput("upload");
          }).on('filepreupload', function(event, data, previewId, index) {
            // console.log(event);
            var n = jsonObj.length;
            if (n>5) {
              return {
                  message: "Max 5 Files can be uploaded", // upload error message
                  data:{} // any other data to send that can be referred in `filecustomerror`
              };
          }
          }).on('fileuploaded', function(event, data, previewId, index) {
              var form = data.form, files = data.files, extra = data.extra,
                  response = data.response, reader = data.reader;
              //console.log('File uploaded triggered '+data.response.file_name);
              item = data.response.file_name;
              jsonObj.push(item);
              //console.log(JSON.stringify(jsonObj));
              $('#filenames').val(JSON.stringify(jsonObj));
          }).on('filebeforedelete', function() {
          return new Promise(function(resolve, reject) {
              $.confirm({
                  title: 'Confirmation!',
                  content: 'Are you sure you want to delete this file?',
                  type: 'red',
                  buttons: {   
                      ok: {
                          btnClass: 'btn-primary text-white',
                          keys: ['enter'],
                          action: function(){
                              resolve();
                          }
                      },
                      cancel: function(){
                          $.alert('File deletion was aborted! ' + krajeeGetCount('file-3'));
                      }
                  }
              });
          });
      }).on('filedeleted', function(event, key, jqXHR, data) {
              //console.log(key);
              var ind=0;
              $.each(jsonObj, function(n, elem) {
                  if(elem==key) ind=n;
              });
            // console.log("index="+ind);
              jsonObj.splice(ind,1);
              //console.log(JSON.stringify(jsonObj));
              $('#filenames').val(JSON.stringify(jsonObj));
          }).on('filesorted', function(event, params) {
                  console.log('File sorted ', params.previewId, params.oldIndex, params.newIndex, params.stack);
                  jsonObj=[];
                  $.each(params.stack, function(n, elem) {
                      jsonObj.push(elem.caption);
                      console.log(elem);
                  });
                  $('#filenames').val(JSON.stringify(jsonObj));
          });                  
        });
    </script>
@endsection