<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getFilenamesFromDirectory')) {
    function getFilenamesFromDirectory($directory)
    {
        $disk = Storage::disk('public');
        $directory = $directory;
        $files = [];
        if ($disk->exists($directory)) {
            $files = $disk->files($directory);
            $files = array_map(function ($path) {
                return basename($path);
            }, $files);
            $files= array_filter($files,function($filename){
                return !in_array($filename,['.ftpquota']);
            });
        }

        return $files;
    }
}
