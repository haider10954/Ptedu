<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getFilenamesFromDirectory')) {
    function getFilenamesFromDirectory($directory)
    {
        $disk = Storage::disk('public');
        $directory = $directory;

        if ($disk->exists($directory)) {
            $files = $disk->files($directory);
            return array_map(function ($path) {
                return basename($path);
            }, $files);
        }

        return $files;
    }
}
