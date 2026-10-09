<?php

if (!function_exists('getFile'))
{
    function getFile($path)
    {
        return \Illuminate\Support\Facades\Storage::disk('s3_public')->temporaryUrl($path, now()->addMinutes(30));
    }
}