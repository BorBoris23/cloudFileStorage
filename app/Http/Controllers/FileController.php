<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\S3Object;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(StoreFileRequest $request)
    {
        foreach ($request->filesToUpload as $file) {
            Storage::disk('s3')->putFileAs($request->directory, $file, $file->getClientOriginalName());
        }
        return Redirect::to('/')->with('status', 'success')->withInput();
    }

    public function destroy()
    {
        return Storage::disk('s3')->delete($_GET['path']);
    }

    public function rename()
    {
        $newFilePath = str_replace($_GET['oldPath'], $_GET['newPath'], $_GET['path']);
        return Storage::disk('s3')->move($_GET['path'], $newFilePath);
    }

    public function download()
    {
        Storage::disk('s3')->download($_GET['path']);
        $data = ['name' => (new S3Object($_GET['path']))->name];
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
