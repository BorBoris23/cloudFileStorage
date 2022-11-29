<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class File extends AbstractModel
{
    public $path;

    public function __construct($path)
    {
        parent::__construct();
        $this->path = $this->rootDirectory . '/' . $path;
    }

    public function getFiles()
    {
        $files = Storage::disk('s3')->files($this->path);
        return $this->getInfo($files);
    }
}
