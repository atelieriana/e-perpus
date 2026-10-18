<?php

if (!function_exists('getFile'))
{
    function getFile($path)
    {
        return \Illuminate\Support\Facades\Storage::disk('s3_public')->temporaryUrl($path, now()->addMinutes(30));
    }
}

if (!function_exists('getOriginalUUID'))
{
    function getOriginalUUID()
    {
        $previousRequest = url()->previous();
        $arrayPreviousRequest = explode('/', $previousRequest);
        return array_last($arrayPreviousRequest);
    }
}