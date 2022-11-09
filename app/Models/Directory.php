<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Directory extends AbstractModel
{
    public $items = [];

    public function __construct($pathToDirectory)
    {
        $this->items = $this->getDirectories($pathToDirectory);
    }

    public function getDirectories($pathToDirectory)
    {
        $directories = Storage::disk('s3')->directories($pathToDirectory);
        return $this->getInfo($directories, $pathToDirectory);
    }
}
