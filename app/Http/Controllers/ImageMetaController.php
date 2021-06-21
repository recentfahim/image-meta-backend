<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Models\ImageMeta;

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
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            $image = Image::make($contents);

            $metas = $this->ImageMeta($image, $name);
            $image->save(public_path('/images/' . $name));

            $image_meta = new ImageMeta();

            $image_meta->image_path = '/public/images/'.$name;
            $image_meta->authorandcopyright = json_encode($metas['result']['iptc_data']);
            $image_meta->camera_info = json_encode($metas['result']['camera_info']);
            $image_meta->exif = json_encode($metas['result']['exif_data']);
            $image_meta->save();

            return response()->json($metas, 200);
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();

            $metas = $this->ImageMeta($request->image, $image_name);

            $destinationPath = public_path().'/images/' ;
            $image->store('images', 'public');
            $image->move($destinationPath, $image_name);

            $image_meta = new ImageMeta();

            $image_meta->image_path = '/public/images/'.$image_name;
            $image_meta->authorandcopyright = json_encode($metas['result']['iptc_data']);
            $image_meta->camera_info = json_encode($metas['result']['camera_info']);
            $image_meta->exif = json_encode($metas['result']['exif_data']);
            $image_meta->save();

            return response()->json($metas, 200);
        }
    }
}
