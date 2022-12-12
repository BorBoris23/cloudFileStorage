<?php

namespace App\Models;

class S3Object extends AbstractModel
{
    public $name;
    public $pathTo;
    public $pathToSubDirectory;

    public function __construct($fullPath)
    {
        parent::__construct();
        $this->name = $this->getName($fullPath);
        $this->pathTo = $fullPath;
        $this->pathToSubDirectory = str_replace($this->rootDirectory . '/', '', $fullPath);
    }

    private function getName($fullPath)
    {
        $arr = explode("/", $fullPath);
        return end($arr);
    }
}
