<h1 align="center">Image Meta</h1>

## About Image Meta

It takes image or image url as user input and return the meta information contains in that image. Like camera information, author and copyright information and EXIF information.


## Build Setup

```bash
# install dependencies
$ composer install

# regenerates the list of all classes that need to be included in the project
$ composer dump-autoload

# serve application at localhost:8000 
$ php artisan serve
```

### Get Image Meta information

**EndPoint:** ```api/image-meta/```

**Method:** ```GET``` 

**Success Response:**

**Status Code:** ```200 OK```

**Response:**
```JSON
{
    "result": {
        "exif_data": {
            "FileName": "20210524_112859.jpg",
            "FileDateTime": 1623869726,
            "FileSize": 1631686,
            "FileType": 2,
            "MimeType": "image/jpeg",
            "SectionsFound": "ANY_TAG, IFD0, THUMBNAIL, EXIF, GPS",
            "ImageWidth": 4032,
            "ImageLength": 3024,
            "Make": "samsung",
            "Model": "SM-A505F",
            "Orientation": 6,
            "XResolution": "72/1",
            "YResolution": "72/1",
            "ResolutionUnit": 2,
            "Software": "A505FDDU7CUD1",
            "DateTime": "2021:05:24 11:28:59",
            "YCbCrPositioning": 1,
            "Exif_IFD_Pointer": 238,
            "GPS_IFD_Pointer": 692,
            "ExposureTime": "1/50",
            "FNumber": "170/100",
            "ExposureProgram": 2,
            "ISOSpeedRatings": 125,
            "ExifVersion": "0220",
            "DateTimeOriginal": "2021:05:24 11:28:59",
            "DateTimeDigitized": "2021:05:24 11:28:59",
            "UndefinedTag:0x9010": "+06:00",
            "UndefinedTag:0x9011": "+06:00",
            "ShutterSpeedValue": "1/50",
            "ApertureValue": "153/100",
            "BrightnessValue": "909/100",
            "ExposureBiasValue": "0/100",
            "MaxApertureValue": "153/100",
            "MeteringMode": 3,
            "Flash": 0,
            "FocalLength": "393/100",
            "ColorSpace": 1,
            "ExifImageWidth": 4032,
            "ExifImageLength": 3024,
            "ExposureMode": 0,
            "WhiteBalance": 0,
            "DigitalZoomRatio": "100/100",
            "FocalLengthIn35mmFilm": 26,
            "SceneCaptureType": 0,
            "ImageUniqueID": "H25LSLJ02AM",
            "GPSLatitudeRef": null,
            "GPSLatitude": [
                "0/0",
                "0/0",
                "0/0"
            ],
            "GPSLongitudeRef": null,
            "GPSLongitude": [
                "0/0",
                "0/0",
                "0/0"
            ]
        },
        "iptc_data": null,
        "camera_info": {
            "Make": "samsung",
            "Model": "SM-A505F",
            "Exposure": "1/50",
            "Aperture": "170/100",
            "Focal Length": "393/100",
            "ISO Speed": 125,
            "Flash": 0
        }
    },
    "success": true
}
```
