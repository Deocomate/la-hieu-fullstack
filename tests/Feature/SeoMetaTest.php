<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

final class SeoMetaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }

    public function test_renders_seo_meta_tags_on_home_page_via_view_composer(): void
    {
        Page::factory()->create([
            'key' => 'home',
            'seo_title' => 'Test SEO Title',
            'seo_description' => 'Test description for search engines.',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('<meta name="description" content="Test description for search engines."', false)
            ->assertSee('<meta property="og:title" content="Test SEO Title"', false);
    }

    public function test_renders_article_seo_on_detail_page(): void
    {
        $article = Article::factory()->create([
            'type' => 'photojournalism',
            'status' => 'published',
            'published_at' => now(),
            'seo_title' => 'Article SEO',
            'seo_description' => 'Article desc',
        ]);

        $this->get(route('photojournalism.show', $article->slug))
            ->assertOk()
            ->assertSee('Article SEO', false)
            ->assertSee('Article desc', false);
    }

    public function test_images_optimize_existing_command_runs_dry_run(): void
    {
        $this->artisan('images:optimize-existing', ['--dry-run' => true])
            ->assertSuccessful();
    }
}
