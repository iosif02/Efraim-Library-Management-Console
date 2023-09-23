<?php

namespace App\Services;

use App\Interfaces\IFileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileService implements IFileService
{
    public function StoreFile(UploadedFile|string $file): string
    {
        $fileName = Storage::putFile('public/image', $file);
        return str_replace("public/", "", $fileName);
    }

    public function GetFile(string $context, string $filename): BinaryFileResponse
    {
        $ds = DIRECTORY_SEPARATOR;
        $basePath = storage_path() . $ds . "app" . $ds . "public";
        $filePath = $basePath . $ds . $context . $ds . $filename;

        return response()->file($filePath);
    }

    public function DeleteFile(?string $path): void
    {
        if(!$path) return;

        Storage::delete('public/' . $path);
    }
}
