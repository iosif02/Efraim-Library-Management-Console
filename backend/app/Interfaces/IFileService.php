<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface IFileService
{
    public function StoreFile(UploadedFile $file, string $directory): string;
    public function GetFile(string $context, string $filename): BinaryFileResponse;
    public function DeleteFile(?string $path): void;
}
