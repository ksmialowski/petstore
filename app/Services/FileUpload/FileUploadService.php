<?php

namespace App\Services\FileUpload;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class FileUploadService
{
    CONST FILE_UPLOAD_URL = 'https://0x0.st';

    /**
     * @throws ConnectionException
     */
    public static function upload(UploadedFile $file): ?string
    {
        $response = Http::attach(
            'file',
            $file->getContent(),
            $file->hashName()
        )->post(self::FILE_UPLOAD_URL);

        if ($response->successful()) {
            return str_replace("\n", "", $response->body());
        }

        return null;
    }
}
