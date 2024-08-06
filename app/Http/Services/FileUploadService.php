<?php

// app/Http/Services/FileUploadService.php
namespace App\Http\Services;

use Illuminate\Http\Request;

class FileUploadService
{
    public function __construct()
    {
    }

    public function uploadFile(Request $request, $fileKey, $filePath)
    {
        $file = $request->file($fileKey);

        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs($filePath, $fileName);

            return $filePath;
        }

        return null;
    }

    public function deleteFile($filePath)
    {
        return \Storage::delete($filePath);
    }
}
