<?php

namespace App\Services;

use App\Interfaces\IFileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService implements IFileService
{
    public function StoreFile(UploadedFile|string $file): string
    {
        $app_url = config('app.app_url') . '/';
        if(is_string($file)) {
            $extension = explode('/', mime_content_type($file))[1];
            $name = 'images/' . uniqid() . '.' . $extension;
            $fileName = $this->base64_to_jpeg($file, $name);
        } else {
            $fileName = $file->getFilename().'.'.$file->extension();
            Storage::disk('public')->put($fileName, $file->getContent());
        }

        return $app_url . $fileName;
    }

    public function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }
}
