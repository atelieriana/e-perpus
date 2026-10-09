<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use Aws\S3\S3Client;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

readonly class UploadService
{
    private S3Client $s3;

    private array $suspiciousPattern;

    private array $allowedExtension;

    /**
     *
     * dari http ke https
     */

    public function __construct()
    {
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'endpoint' => config('filesystems.disks.s3.endpoint'),
            'use_path_style_endpoint' => config('filesystems.disks.s3.use_path_style_endpoint'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ]
        ]);

        $this->suspiciousPattern = [
            '/\/JavaScript\s*/i',
            '/\/JS\s*\((.*?)\)/is',
            '/\/S\s*\/JavaScript/i',
            '/\/OpenAction.*?\/JS\s*\((.*?)\)/is',
            '/<\?php(.*?)\?>/is',
            '/<script\b[^>]*>(.*?)<\/script>/is'
        ];

        $this->allowedExtension = [
            'pdf',
            'png',
            'jpg',
            'jpeg'
        ];
    }

    /**
     * Digunakan untuk melakukan upload pada Minio Server
     *
     * @param string $directory
     * @param UploadedFile $file
     * @return string|void
     * @throws Exception
     */
    public function upload(string $directory, UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = sha1(time() . rand(0, 100)) . "." . $extension;

        if (!in_array($extension, $this->allowedExtension))
            throw new BusinessException('File Hanya boleh PDF');

        if ($this->checkSuspiciousPattern($file->getContent()))
            throw new BusinessException('File terdeteksi sebagai malicious');

        try {
            $this->s3->putObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $directory . '/' . $filename,
                'ContentLength' => $file->getSize(),
                'Body' => $file->getContent()
            ]);

            return $directory . '/' . $filename;
        } catch (BusinessException $s3Exception) {
            Log::error($s3Exception);
        }
    }

    public function uploadPhoto(string $directory, UploadedFile $file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = sha1(time() . rand(0, 100)) . "." . $extension;

        // Allowed extensions khusus foto
        $allowedPhotoExtensions = ['jpg', 'jpeg', 'png'];

        if (!in_array($extension, $allowedPhotoExtensions)) {
            throw new BusinessException('File hanya boleh JPG atau PNG');
        }

        // Cek MIME type (lebih aman dibanding hanya extension)
        if (!str_starts_with($file->getMimeType(), 'image/')) {
            throw new BusinessException('File bukan gambar valid');
        }

        // Opsional: cek malicious pattern kalau diperlukan
        if (method_exists($this, 'checkSuspiciousPattern')
            && $this->checkSuspiciousPattern($file->getContent())) {
            throw new BusinessException('File terdeteksi sebagai malicious');
        }

        try {
            $this->s3->putObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $directory . '/' . $filename,
                'ContentLength' => $file->getSize(),
                'Body' => $file->getContent(),
                'ContentType' => $file->getMimeType(), // penting biar bisa preview
                'ACL' => 'public-read', // opsional kalau mau bisa diakses publik
            ]);

            return $directory . '/' . $filename;
        } catch (BusinessException $s3Exception) {
            Log::error($s3Exception);
            throw new BusinessException('Upload foto gagal');
        }
    }


    /**
     * @param $filecontent
     * @return bool
     */
    private function checkSuspiciousPattern($filecontent): bool
    {
        $found = false;
        foreach ($this->suspiciousPattern as $pattern) {
            if (preg_match_all($pattern, $filecontent)) {
                $found = true;
            }
        }

        return $found;
    }
}