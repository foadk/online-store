<?php

namespace App\Services;

class NameGenerator {

    private $randomName;

    public function __construct()
    {
        $this->generate();
    }

    /**
     * Create an image name.
     *
     * @return string
     */
    public function getImageName()
    {
        return 'image' . '_' . $this->randomName . '.' . 'jpg';
    }

    /**
     * Create a Thumbnail name.
     *
     * @return string
     */
    public function getThumbnailName()
    {
        return 'image' . '_' . $this->randomName . '_thumbnail' . '.' . 'jpg';
    }

    /**
     * Generate a random name with time();
     */
    public function generate()
    {
        $this->randomName = time();
    }
}