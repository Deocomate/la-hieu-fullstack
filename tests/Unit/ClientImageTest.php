<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Support\ClientImage;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

final class ClientImageTest extends TestCase
{
    public function test_resolves_static_assets_via_asset_helper(): void
    {
        $url = ClientImage::url('assets/static/home/hero-logo.svg');

        $this->assertSame(asset('assets/static/home/hero-logo.svg'), $url);
    }

    public function test_resolves_uploads_via_storage_disk(): void
    {
        $url = ClientImage::url('articles/covers/photo.jpg');

        $this->assertSame(Storage::disk('public')->url('articles/covers/photo.jpg'), $url);
    }

    public function test_passes_through_absolute_urls(): void
    {
        $url = ClientImage::url('https://example.com/img.jpg');

        $this->assertSame('https://example.com/img.jpg', $url);
    }

    public function test_uses_fallback_when_path_is_empty(): void
    {
        $url = ClientImage::url(null, 'assets/static/home/hero.png');

        $this->assertSame(asset('assets/static/home/hero.png'), $url);
    }
}
