@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Edit Balance')
@section('page-styles')
    <link href="{{ asset('vendors/plugins/font_awesome/css/all.css') }} " media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/plugins/fileinput/css/fileinput.css') }} " media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/plugins/fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/plugins/fileinput/css/jquery-confirm.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
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
                @if ($list)                                    
                <form action="{{url('balance/edit_request') }}" class="needs-validation" method="post">
                <div class="row">
                  <div class="col-md-8"> 
                        @csrf                        
                    <fieldset class="form-group">
                      <input type="hidden" id="request_id" name="request_id"  value="{{ $list->bh_id }}" />
                      <label for="balance_amount">Balance Amount</label>
                      <input type="number" min="1" step="0.01" class="form-control" id="balance_amount" name="balance_amount" required  placeholder="Enter Amount" value="{{ old('balance_amount',$list->requested_amount) }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="date">Date</label>
                      <input type="text" class="form-control" id="date" name="date" required  placeholder="Enter Date" value="{{ old('date',date('d/m/Y',strtotime($list->date))) }}">
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="description">Description <small>optional</small></label>
                      <textarea class="form-control" id="description" name="description" required  placeholder="Enter description">{{ old('description',$list->bh_description) }}</textarea>
                    </fieldset>                    
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                  <div class="col-md-4">
                    <label for="formFileMultiple" class="form-label">Image</label>
                    <input type="hidden" id="filenames" name="filenames"  value="{{ old('filenames',$list->bh_images)}}" />
                    <div class="file-loading">
                      <input id="images" type="file" accept="image/*" >
                  </div>
                  </div>                  
                </div>
              </form>
              @else 
                No Detail found
              @endif
            </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
echo 'names='.old('filenames',$list->bh_images);
$files=json_decode(old('filenames',$list->bh_images),true);
print_r($files);
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