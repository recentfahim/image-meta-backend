<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ImageMetaController extends Controller
{
    public function ExtractImageMeta(Request $request){
        if($request->image){
            $exif_info = Image::make($request->image)->exif();
            $iptc = Image::make($request->image)->iptc();
            unset($exif_info['COMPUTED']);
            unset($exif_info['THUMBNAIL']);
            $exif_info['FileName'] = $request->image->getClientOriginalName();
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
                return response()->json(array('result' => array('exif_data' => $exif_info, 'iptc_data' => $iptc, 'camera_info' => $camera_info), 'success' => true), 200);
            }

            return response()->json(array('result' => array('exif_data' => $exif_info, 'iptc_data' => $iptc, 'camera_info' => $camera_info), 'success' => true), 200);

        }
    }
}
