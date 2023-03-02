<?php


namespace arghavan\Media\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use arghavan\Media\Contracts\FileServiceContract;
use arghavan\Media\Models\Media;

class ImageFileService extends DefaultFileService implements FileServiceContract
{
    protected static $sizes = ['300','600'];
    public static function upload($file,$filename,$dir)
    {
        Storage::putFileAs($dir,$file,$filename. '.' . $file->getClientOriginalExtension());
        $path = $dir.$filename.'.'.$file->getClientOriginalExtension();
        return self::resize(Storage::path($path),$dir,$filename,$file->getClientOriginalExtension());
    }


    private static function resize($img,$dir,$filename,$extension)
    {
        $img = Image::make($img);
        $imgs['original'] = $filename.'.'.$extension;

        foreach (self::$sizes as $size)
        {
            $imgs[$size] = $filename.'_'.$size.'.'.$extension;
            $img->resize($size,null,function ($aspect){
                $aspect->aspectRatio();
            })->save(Storage::path($dir).$filename.'_'.$size. '.' .$extension);
        }
        return $imgs;
    }



    public static function thumb(Media $media)
    {
        return "/storage/".$media->files['300'];

    }
}
