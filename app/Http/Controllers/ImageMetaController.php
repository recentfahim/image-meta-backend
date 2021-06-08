<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ImageMetaController extends Controller
{
    public function ExtractImageMeta(Request $request){
        if($request->image){
            $data = Image::make($request->image)->exif();
            Log::channel('stderr')->info($data);
        }
    }
}
