<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $path = '';
        if(!empty($_GET)) {
            $path = $_GET['path'];
        }
        $content['files'] = (new File($path))->getFiles();
        $content['directories'] = (new Directory($path))->getDirectories();

        return (view('index', compact('content')));
    }
}
