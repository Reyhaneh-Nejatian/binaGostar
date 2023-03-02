<?php


namespace arghavan\Media\Services;


use arghavan\Media\Contracts\FileServiceContract;
use arghavan\Media\Models\Media;

class MediaFileService
{
    private static $file;
    private static $dir;
    private static $is_private;
    public static function privateUpload($file)
    {
        self::$file = $file;
        self::$dir = 'private/';
        self::$is_private = true;
        return self::upload();
    }

    public static function publicUpload($file)
    {
        self::$file = $file;
        self::$dir = 'public/';
        self::$is_private = false;
        return self::upload();
    }

    private static function upload()
    {
        $extension = self::normalizeExtension(self::$file);
        foreach (config('mediaFile.MediaTypeServices') as $type => $service)
        {
            if(in_array($extension,$service['extensions']))
            {
                return self::uploadByHandler(new $service['handler'],$type);
            }
        }
    }


    private static function normalizeExtension($file):string
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private static function filenameGenerator()
    {
        return uniqid();
    }

    private static function uploadByHandler(FileServiceContract $service,string $type): Media
    {
        $media = new Media();
        $media->files = $service::upload(self::$file,self::filenameGenerator(),self::$dir);
        $media->type = $type;
        $media->user_id = auth()->id();
        $media->filename = self::$file->getClientOriginalName();
        $media->is_private = self::$is_private;
        $media->save();
        return $media;
    }


    public static function thumb(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service)
        {
            if($media->type == $type){
                return $service['handler']::thumb($media);
            }
        }
    }

    public static function delete(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service)
        {
            if($media->type == $type){
                return $service['handler']::delete($media);
            }
        }
    }


}
