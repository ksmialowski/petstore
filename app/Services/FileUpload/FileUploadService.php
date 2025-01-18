<?php

namespace App\Services\FileUpload;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class FileUploadService
{
    /**
     * @throws ConnectionException
     */
    public static function upload(UploadedFile $file): ?string
    {
        $response = Http::attach(
            'file',
            $file->getContent(),
            $file->hashName()
        )->post(config('url.file_base_url', ''));

        if ($response->successful()) {
            return str_replace("\n", "", $response->body());
        }

        return null;
    }
}
