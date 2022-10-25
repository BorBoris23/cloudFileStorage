<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function index()
    {
        return (view('index'));
    }

    public function show()
    {
        $directory = 'user-'.Auth::user()->id.'-files';
        $files = File::getAllFilesInDirectory($directory);
        return (view('usersFiles', compact('files', 'directory')));
    }

    public function store(StoreFileRequest $request)
    {
        foreach ($request->filesToUpload as $file) {
            Storage::disk('s3')->putFileAs($request->directory, $file, $file->getClientOriginalName());
        }
        return Redirect::to('/')->with('status', 'success')->withInput();
    }

    public function destroy(Request $request)
    {
        return Storage::disk('s3')->delete($request->pathToFile);
    }

    public function rename(Request $request)
    {
        $newFilePath = strtok($request->pathToFile, '/') . '/' . $request->newFileName;

        return Storage::disk('s3')->move($request->pathToFile, $newFilePath);

    }

    public function upload(Request $request)
    {
        return Storage::disk('s3')->download($request->pathToFile);
    }
}

