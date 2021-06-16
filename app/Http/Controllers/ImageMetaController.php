<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ImageMetaController extends Controller
{

    public function ImageMeta($file, $name){
        $exif_info = Image::make($file)->exif();
        $iptc = Image::make($file)->iptc();
        unset($exif_info['COMPUTED']);
        unset($exif_info['THUMBNAIL']);
        $exif_info['FileName'] = $name;
        $camera_info = null;
        try {
            $camera_info = array(
                "Make" => $exif_info['Make'],
                "Model" => $exif_info['Model'],
                "Exposure" =>$exif_info['ExposureTime'],
                "Aperture" => $exif_info['FNumber'],
                "Focal Length" =>$exif_info['FocalLength'],
                "ISO Speed" =>$exif_info['ISOSpeedRatings'],
                "Flash" =>$exif_info['Flash']
            );
        }
        catch(Exception $e){
            return array('result' => array('exif_data' => $exif_info, 'iptc_data' => $iptc, 'camera_info' => $camera_info), 'success' => true);
        }

        return array('result' => array('exif_data' => $exif_info, 'iptc_data' => $iptc, 'camera_info' => $camera_info), 'success' => true);
    }

    public function ExtractImageMeta(Request $request){
        if($request->image_url){
            $url = $request->image_url;
            $contents = Image::make($url);
            $name = substr($url, strrpos($url, '/') + 1);

            $metas = $this->ImageMeta($contents, $name);
            return response()->json($metas, 200);
        }

        if($request->image){
            $name = $request->image->getClientOriginalName();
            $metas = $this->ImageMeta($request->image, $name);

            return response()->json($metas, 200);
        }
    }
}
