<?php

namespace App\Http\Controllers\Web\CKEditor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CKEditorController extends Controller
{
  public function upload(Request $request)
  {
    if($request->hasFile('upload')) {

      $imageFilePath = 'storage/ckeditor/';
      if (!file_exists($imageFilePath)) mkdir($imageFilePath, 0777, true);

      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $fileName = $fileName.'_'.time().'.'.$extension;
  
      $request->file('upload')->move(public_path($imageFilePath), $fileName);
      $url = asset($imageFilePath.$fileName); 
      
      return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
    }
  }

}