<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudder;
use App\File;

class FileController extends Controller
{
    public function uploadFiles(Request $request)
    {
    	$this->validate($request,[
       'file_name'=>'required|mimes:jpeg, bmp, png|between:1, 5000',
    	]);
     $file_name = $request->file('file_name')->getRealPath();;

     Cloudder::upload($file_name, null);
     list($width, $height) = getimagesize($file_name);

     $public_Id = Cloudder::getPublicId();

     $file_url= Cloudder::show($public_Id, ["width" => $width, "height"=>$height]);

     $this->saveFiles($request, $file_url);

     return redirect()->back()->with('status', 'Your file has been uploaded successfully');

    }

    public function saveFiles(Request $request, $file_url)
    {
    	$file = new File;
    	$file->file_name = $request->file('file_name')->getClientOriginalName();
    	$file->file_url = $file_url;

    	$file->save();
    }

    public function index()
    {
    	$files = File::all();
    	return view('index', compact('files'));
    }
}
