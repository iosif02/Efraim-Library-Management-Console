<?php

namespace App\Services;

use App\Interfaces\IFileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService implements IFileService
{
    public function StoreFile(UploadedFile $file) {
        $fileName = $file->getFilename().'.'.$file->extension();
        Storage::disk('public')->put($fileName, $file->getContent());

        return 'images/' . $fileName;
    }
}
