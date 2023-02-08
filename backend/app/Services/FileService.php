<?php

namespace App\Services;

use App\Interfaces\IFileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService implements IFileService
{
    public function StoreFile(UploadedFile|string $file): string
    {
        if(is_string($file)) {
            $location = Storage::get('public/images') . uniqid() . '.png';
            $fileName = $this->base64_to_jpeg($file, $location);
        } else {
            $fileName = $file->getFilename().'.'.$file->extension();
            Storage::disk('public')->put($fileName, $file->getContent());
        }

        return 'images/' . $fileName;
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
