<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageOptimizationService
{
    /**
     * Upload and optimize image to WebP format (Intervention Image V4)
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    public function upload(UploadedFile $file, string $folder, int $width = null, int $height = null): string
    {
        // Generate a random filename starting with 'item-' for compatibility with the project's helper
        $filename = 'item-' . Str::random(20) . '.webp';
        $path = $folder . '/' . $filename;

        // Create manager using the desired driver (Intervention V4 syntax)
        $manager = ImageManager::usingDriver(Driver::class);

        // Read image data as binary content to avoid permission issues with Windows Temp folder
        $image = $manager->decodeBinary($file->get());

        // Scale image if dimensions are provided
        if ($width || $height) {
            $image->scale(width: $width, height: $height);
        }

        // Encode using WebP format (V4 syntax)
        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: 80);

        // Store the encoded image in the public disk
        Storage::disk('public')->put($path, (string) $encoded);

        \Illuminate\Support\Facades\Log::info('Service Upload - Filename: ' . $filename);

        // Return only the filename as the database expects just the name (the helper adds the folder)
        return (string) $filename;
    }
}
