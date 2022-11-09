<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class File extends AbstractModel
{
    public $items = [];

    public function __construct($pathToFile)
    {
        $this->items = $this->getFiles($pathToFile);
    }

    public function getFiles($pathToFile)
    {
        $files = Storage::disk('s3')->files($pathToFile);
        return $this->getInfo($files, $pathToFile);
    }
}
