<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface IFileService
{
    public function StoreFile(UploadedFile $file);
}
