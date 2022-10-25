<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    public static function getAllFilesInDirectory($directory)
    {
        return Storage::allFiles($directory);
    }
}
