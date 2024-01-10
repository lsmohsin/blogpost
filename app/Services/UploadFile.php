<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public function upload(UploadedFile $file)
    {
        $path = $file->store('uploads', 'public');
        return $path;
    }
}
