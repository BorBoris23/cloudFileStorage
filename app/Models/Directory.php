<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Directory extends AbstractModel
{
    public $path;

    public function __construct($path)
    {
        parent::__construct();
        $this->path = $this->rootDirectory . '/' . $path;
    }

    public function getDirectories()
    {
        $directories = Storage::disk('s3')->directories($this->path);
        return $this->getInfo($directories);
    }
}
