<?php

namespace App\Models;

class Response
{
    public $name;
    public $path;

    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
    }
}
