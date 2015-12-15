<?php

namespace App\Services;

use Image;


class InterventionImageEditor implements ImageEditorInterface {
    
    private $image;

    /**
     * Retrieve the image from image path;
     *
     * @param $imagePath
     *
     */
    public function setImage($imagePath)
    {
        $this->image = Image::make($imagePath);
    }

    /**
     * @param int $width
     */
    public function createThumbnail($width = 180)
    {
        $this->image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $this->image->save();
    }
}