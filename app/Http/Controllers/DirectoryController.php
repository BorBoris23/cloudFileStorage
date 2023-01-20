<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectoryRequest;
use App\Providers\RouteServiceProvider;
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

    public function rename()
    {
        $directoryContents = Storage::disk('s3')->allFiles($_GET['path']);
        foreach ($directoryContents as $directoryContent) {
            $newPath = str_replace($_GET['oldPath'], $_GET['newPath'], $directoryContent);
            Storage::disk('s3')->move($directoryContent, $newPath);
        }
        $data = ['newPath' => $_GET['newPath']];
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
