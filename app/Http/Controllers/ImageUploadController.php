<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ImageUploadController extends Controller
{
    public function upload_file(Request $req) {
        $req->validate([
            'file_data' => 'required|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        if($req->file()) {
            $fileName = time().'_'.$req->file_data->getClientOriginalName();
            $filePath = $req->file('file_data')->storeAs('', $fileName, 'public');
            $response=array();
            $response['initialPreview']=getenv('app_url').Storage::url('app/public/'.$fileName);
            $response['initialPreviewAsData']=true;
            $f_config=array('caption'=>$fileName,'width'=>'120px','url'=>url('delete_file/?_token='.csrf_token()),'key'=>$fileName,'size'=>$req->file('file_data')->getSize());
            $file_type=$req->file('file_data')->getMimeType();
            if($file_type=='application/pdf') {
					$f_config['type']='pdf';
				} else if($file_type=='video/mp4') { 
					$f_config['type']='video';
					$f_config['filetype']=$file_type;
					$f_config['downloadUrl']=Storage::url($fileName);
					$f_config['filename']=$fileName;
				}
				$response['initialPreviewConfig']=[$f_config];
				$response['append']=true;
				$response['file_name']=$fileName;
            echo json_encode($response);
        }
    }
    public function delete_file(Request $req) {
        if($req->get('key')!=null) {
			@unlink(Storage::path('public/'.$req->get('key')));
			$response['success']=true;
		} else $response['error']='File does not exists';
		echo json_encode($response);
		exit;
    }
}