<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
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

    public function destroy(Request $request)
    {
        return Storage::disk('s3')->delete($request->pathTo);
    }

    public function rename(Request $request)
    {
        $newFilePath = str_replace($request->oldFileName, $request->newFileName, $request->pathTo);
        return Storage::disk('s3')->move($request->pathTo, $newFilePath);
    }

    public function upload(Request $request)
    {
        return Storage::disk('s3')->download($request->pathToFile);
    }
}
