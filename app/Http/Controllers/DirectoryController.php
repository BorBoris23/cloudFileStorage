<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectoryRequest;
use App\Models\Directory;
use App\Models\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DirectoryController extends Controller
{
    public function store(StoreDirectoryRequest $request)
    {
        $filesName = $_FILES['directoryToUpload']['name'];
        $filesPath = $_FILES['directoryToUpload']['full_path'];

        for ($i = 0; $i < count($filesName); $i++) {
            $path = str_replace($filesName[$i], '',  $filesPath[$i]);
            Storage::disk('s3')->putFileAs($request->directory.'/'.$path, $request->directoryToUpload[$i], $filesName[$i]);
        }
        return Redirect::to('/')->with('status', 'success')->withInput();
    }
    public function toDirectory($path)
    {
        $rootDirectory = Session::get('rootDirectory');
        $currentDirectory = $rootDirectory . $path;
        $directories = new Directory($currentDirectory);
        $files = new File($currentDirectory);
        return (view('index', compact( 'rootDirectory','directories', 'files')));
    }
}
