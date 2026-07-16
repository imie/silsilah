<?php

namespace Tests\Unit\Jobs\Images;

use App\Jobs\Images\OptimizeImages;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OptimizeImagesTest extends TestCase
{
    public function test_resize_image_into_a_proper_height()
    {
        Storage::fake(config('filesystem.default'));
        Storage::assertMissing('portrait_image.jpg');

        $image = \Illuminate\Http\UploadedFile::fake()->image('portrait_image.jpg', 300, 400);
        copy($image->path(), Storage::path('portrait_image.jpg'));
        dispatch(new OptimizeImages([Storage::path('portrait_image.jpg')]));

        Storage::assertExists('portrait_image.jpg');
    }

    public function test_resize_image_into_a_proper_width()
    {
        Storage::fake(config('filesystem.default'));
        Storage::assertMissing('landscape_image.jpg');

        $image = \Illuminate\Http\UploadedFile::fake()->image('landscape_image.jpg', 400, 300);
        copy($image->path(), Storage::path('landscape_image.jpg'));
        dispatch(new OptimizeImages([Storage::path('landscape_image.jpg')]));

        Storage::assertExists('landscape_image.jpg');
    }
}
