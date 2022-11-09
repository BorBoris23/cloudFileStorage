<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

abstract class AbstractModel
{
    public function info($fullPath, $pathTo)
    {
        $object = array();
        $object['name'] = str_replace($pathTo .'/', '', $fullPath);
        $object['pathTo'] = $fullPath;
        $object['pathToSubDirectory'] = str_replace(Session::get('rootDirectory'), '', $fullPath);
        return $object;
    }

    public function getInfo($array, $path)
    {
        $items = [];
        foreach ($array as $item) {
            $items[] = $this->info($item, $path);
        }
        return $items;
    }
}


