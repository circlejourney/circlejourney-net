<?php namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService {
    public function upload($file, $target_folder, $old_path=null) {
        /**
         * $target_folder and $old_path are relative to /public/uploads. $old_path is 
         * $target_folder is the relative path of the directory where $file is to be uploaded. Will be created if it doesn't exist.
         * $old_path is the relative path to the file to be replaced. It will be null if 
         */
        preg_match("/(.*)\.[A-Za-z0-9]+/", $file->getClientOriginalName(), $pathmatches);
        $filename = preg_replace("/\s/", "-", $pathmatches[1]) . "." . $file->extension();
        $target_path = $target_folder . "/" . $filename;
        
        if( file_exists(realpath($target_path)) && realpath($target_path) !== realpath($old_path) ) {
            return false;
        }
        
        if( file_exists(realpath($old_path)) && $old_path !== null ) {
            unlink( realpath($old_path) );
        };

        $file->move(public_path($target_folder), $filename);
        return $target_path;
    }
    
    public function generate_thumbnail($src_filepath, $target_folder) {
        $maxsize = config("services.fileupload.thumbnail_max_size");
        error_log($maxsize);

        if(!$imagesize = getimagesize($src_filepath) ) {
            return false;
        };

        $hwratio = $imagesize[1] / $imagesize[0];
        $scaleH = $imagesize[1] > $imagesize[0] ? $maxsize : $maxsize * $hwratio;
        $scaleW = $imagesize[0] > $imagesize[1] ? $maxsize : $maxsize / $hwratio;
        preg_match("/([^\/\\\]+)\.[A_Za-z]{3,4}$/", $src_filepath, $matches);
        $filename = $matches[1]."-thumb.png";
        $target_path = $target_folder . "/" . $filename;

        if($imagesize[1] <= $maxsize && $imagesize[0] <= $maxsize) {
            copy($src_filepath, $target_path);
            return $target_path;
        }

        $format = explode("/", $imagesize["mime"])[1];
        $imagecreatefunc = "imagecreatefrom".$format;
        
        $source_image_blob = $imagecreatefunc($src_filepath);
        $destination_image_blob = imagecreatetruecolor($scaleW, $scaleH);
        imagealphablending($destination_image_blob, false);
        imagesavealpha($destination_image_blob, true);
        $clear = imagecolorallocatealpha($destination_image_blob, 255, 255, 255, 127);
        imagefilledrectangle($destination_image_blob, 0, 0, $scaleW, $scaleH, $clear);
        
        imagecopyresampled( $destination_image_blob, $source_image_blob,
            0, 0,
            0, 0,
            $scaleW, $scaleH,
            $imagesize[0], $imagesize[1]
        );
        
        if(file_exists(realpath($target_path))) {
            unlink(realpath($target_path));
        }

        imagepng($destination_image_blob, $target_path);
        
        return $target_path;
    }
}
