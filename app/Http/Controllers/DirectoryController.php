<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectoryRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        return Redirect::to(RouteServiceProvider::HOME)->with('status', 'success')->withInput();
    }

    public function rename(Request $request)
    {
        $directoryContents = Storage::disk('s3')->allFiles($request->pathTo);
        foreach ($directoryContents as $directoryContent) {
            $newPath = str_replace($request->oldDirectoryName, $request->newDirectoryName, $directoryContent);
            Storage::disk('s3')->move($directoryContent, $newPath);
        }
    }
}
