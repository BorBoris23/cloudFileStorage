<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

abstract class AbstractModel
{
    public $rootDirectory;

    public function __construct()
    {
        $this->rootDirectory = Session::get('rootDirectory');
    }

    public function getInfo($array)
    {
        $items = [];
        foreach ($array as $item) {
            $items[] = new S3Object($item);
        }
        return $items;
    }
}
