<?php


namespace arghavan\Media\Contracts;


use Illuminate\Http\UploadedFile;
use arghavan\Media\Models\Media;

interface FileServiceContract
{
    public static function upload(UploadedFile $file,string $filename,string $dir);

    public static function delete(Media $media);

    public static function thumb(Media $media);
}
