<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\EventAlbum;
use App\Support\GalleryImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class GalleryImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_maps_media_collection_to_lightbox_payload_sorted_by_priority(): void
    {
        $album = EventAlbum::factory()->create();

        $album->media()->create([
            'collection_name' => 'gallery',
            'file_name' => 'b.jpg',
            'file_url' => 'assets/static/testing/b.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
            'width' => 800,
            'height' => 600,
            'custom_properties' => [],
            'priority' => 2,
        ]);

        $album->media()->create([
            'collection_name' => 'gallery',
            'file_name' => 'a.jpg',
            'file_url' => 'assets/static/testing/a.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
            'width' => 1920,
            'height' => 1080,
            'custom_properties' => [],
            'priority' => 1,
        ]);

        $result = GalleryImage::fromMediaCollection($album->fresh()->media, 'Test');

        $this->assertCount(2, $result);
        $this->assertStringContainsString('a.jpg', $result[0]['src']);
        $this->assertSame('Test 1', $result[0]['alt']);
        $this->assertSame(1920, $result[0]['width']);
        $this->assertStringContainsString('b.jpg', $result[1]['src']);
    }

    public function test_maps_string_paths_with_client_image_urls(): void
    {
        $result = GalleryImage::fromPaths(['assets/static/testing/test.png'], 'Img');

        $this->assertCount(1, $result);
        $this->assertStringContainsString('test.png', $result[0]['src']);
        $this->assertStringContainsString('test.png', $result[0]['thumb']);
        $this->assertSame('Img 1', $result[0]['alt']);
        $this->assertSame(0, $result[0]['width']);
        $this->assertSame(0, $result[0]['height']);
    }

    public function test_maps_media_without_dimensions_to_zero(): void
    {
        $album = EventAlbum::factory()->create();

        $album->media()->create([
            'collection_name' => 'gallery',
            'file_name' => 'portrait.jpg',
            'file_url' => 'assets/static/testing/portrait.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
            'width' => null,
            'height' => null,
            'custom_properties' => [],
            'priority' => 1,
        ]);

        $result = GalleryImage::fromMediaCollection($album->fresh()->media, 'Portrait');

        $this->assertSame(0, $result[0]['width']);
        $this->assertSame(0, $result[0]['height']);
    }

    public function test_filters_empty_paths(): void
    {
        $result = GalleryImage::fromPaths(['', 'https://example.com/photo.jpg'], 'Photo');

        $this->assertCount(1, $result);
        $this->assertSame('https://example.com/photo.jpg', $result[0]['src']);
    }
}
