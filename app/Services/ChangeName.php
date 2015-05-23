<?php

namespace App\Services;

class ChangeName {

    public static function changeToThumbnail($image)
    {
        $nameParts = pathinfo($image);
        $Name = $nameParts['filename'];
        $pattern = "/$Name/";
        $replace = $Name. '_tn';
        $newName = preg_replace($pattern, $replace, $image);

        return $newName;
    }
}
