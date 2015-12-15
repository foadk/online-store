<?php

namespace App\Services;

Interface ImageEditorInterface {
    public function createThumbnail($width = 180);
}