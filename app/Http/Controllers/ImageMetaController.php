<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ImageMetaController extends Controller
{
    public function ExtractImageMeta(Request $request){
        if($request->image){
            $exif_info = Image::make($request->image)->exif();
            Log::channel('stderr')->info($request->all());
            $iptc = Image::make($request->image)->iptc();
            return response()->json(array('result' => array('exif_data' => $exif_info, 'iptc_data' => $iptc), 'success' => true), 200);
        }
    }
}
