<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\EventAlbum;
use App\Models\FacesPlacesAlbum;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\SocialFeed;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

final class ClientPageDataBindingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }

    public function test_homepage_renders_only_public_featured_dynamic_data(): void
    {
        $this->createPage('home');
        $category = ArticleCategory::factory()->create(['name' => 'Stories', 'slug' => 'stories']);

        EventAlbum::factory()->create([
            'title' => 'Visible Event Album',
            'slug' => 'visible-event-album',
            'is_featured' => true,
            'status' => 'published',
            'priority' => 1,
        ]);
        EventAlbum::factory()->create([
            'title' => 'Hidden Event Album',
            'slug' => 'hidden-event-album',
            'is_featured' => true,
            'status' => 'hidden',
            'priority' => 2,
        ]);
        EventAlbum::factory()->create([
            'title' => 'Unfeatured Event Album',
            'slug' => 'unfeatured-event-album',
            'is_featured' => false,
            'status' => 'published',
            'priority' => 3,
        ]);

        $facesAlbum = FacesPlacesAlbum::factory()->create([
            'title' => 'Visible Faces Album',
            'slug' => 'visible-faces-album',
            'status' => 'published',
        ]);
        $facesAlbum->media()->create($this->mediaAttributes('faces-visible.png'));

        Article::factory()->create([
            'type' => 'photojournalism',
            'category_id' => $category->id,
            'title' => 'Visible Featured Photo Story',
            'slug' => 'visible-featured-photo-story',
            'is_featured' => true,
            'status' => 'published',
        ]);
        Article::factory()->create([
            'type' => 'photojournalism',
            'category_id' => $category->id,
            'title' => 'Hidden Featured Photo Story',
            'slug' => 'hidden-featured-photo-story',
            'is_featured' => true,
            'status' => 'hidden',
        ]);
        Article::factory()->create([
            'type' => 'videography',
            'category_id' => $category->id,
            'title' => 'Visible Video Story',
            'slug' => 'visible-video-story',
            'status' => 'published',
        ]);

        Partner::factory()->create([
            'name' => 'Visible Partner',
            'status' => 'published',
        ]);
        Partner::factory()->create([
            'name' => 'Hidden Partner',
            'status' => 'hidden',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Visible Event Album');
        $response->assertDontSee('Hidden Event Album');
        $response->assertDontSee('Unfeatured Event Album');
        $response->assertSee('faces-visible.png');
        $response->assertSee('visible-featured-photo-story');
        $response->assertDontSee('Hidden Featured Photo Story');
        $response->assertSee('Visible Video Story');
        $response->assertSee('Visible Partner');
        $response->assertDontSee('Hidden Partner');
    }

    public function test_index_pages_render_dynamic_records_media_categories_and_pagination(): void
    {
        $this->createPage('event-photos');
        $this->createPage('faces-and-places');
        $this->createPage('photojournalism');
        $this->createPage('videography');

        $category = ArticleCategory::factory()->create(['name' => 'Documentary', 'slug' => 'documentary']);

        $eventAlbum = EventAlbum::factory()->create([
            'title' => 'Dynamic Event Album',
            'slug' => 'dynamic-event-album',
            'status' => 'published',
        ]);
        $eventAlbum->media()->create($this->mediaAttributes('dynamic-event-gallery.png'));

        $facesAlbum = FacesPlacesAlbum::factory()->create([
            'title' => 'Dynamic Faces Album',
            'slug' => 'dynamic-faces-album',
            'status' => 'published',
        ]);
        $facesAlbum->media()->create($this->mediaAttributes('dynamic-faces-gallery.png'));

        foreach (range(1, 11) as $number) {
            Article::factory()->create([
                'type' => 'photojournalism',
                'category_id' => $category->id,
                'title' => "Photo Story {$number}",
                'slug' => "photo-story-{$number}",
                'status' => 'published',
                'priority' => $number,
            ]);
        }

        Article::factory()->create([
            'type' => 'videography',
            'category_id' => $category->id,
            'title' => 'Video Story Index',
            'slug' => 'video-story-index',
            'status' => 'published',
        ]);

        $this->get('/event-photos')
            ->assertOk()
            ->assertSee('Dynamic Event Album')
            ->assertSee('dynamic-event-gallery.png');

        $this->get('/faces-and-places')
            ->assertOk()
            ->assertSee('Dynamic Faces Album')
            ->assertSee('dynamic-faces-gallery.png');

        $this->get('/photojournalism')
            ->assertOk()
            ->assertSee('Photo Story 1')
            ->assertSee('Documentary')
            ->assertSee('page=2');

        $this->get('/videography')
            ->assertOk()
            ->assertSee('Video Story Index')
            ->assertSee('Documentary');
    }

    public function test_detail_pages_render_dynamic_content_and_reject_non_public_slugs(): void
    {
        $category = ArticleCategory::factory()->create(['name' => 'Field Notes', 'slug' => 'field-notes']);

        $eventAlbum = EventAlbum::factory()->create([
            'title' => 'Event Detail Album',
            'slug' => 'event-detail-album',
            'status' => 'published',
        ]);
        $eventAlbum->media()->create($this->mediaAttributes('event-detail-gallery.png'));

        EventAlbum::factory()->create([
            'title' => 'Draft Event Detail Album',
            'slug' => 'draft-event-detail-album',
            'status' => 'draft',
        ]);

        $facesAlbum = FacesPlacesAlbum::factory()->create([
            'title' => 'Faces Detail Album',
            'slug' => 'faces-detail-album',
            'status' => 'published',
        ]);
        $facesAlbum->media()->create($this->mediaAttributes('faces-detail-gallery.png'));

        $photoArticle = Article::factory()->create([
            'type' => 'photojournalism',
            'category_id' => $category->id,
            'title' => 'Photo Detail Article',
            'slug' => 'photo-detail-article',
            'status' => 'published',
            'content_blocks' => [
                ['type' => 'paragraph', 'text' => 'Dynamic paragraph from database.'],
            ],
        ]);
        $photoArticle->media()->create($this->mediaAttributes('photo-detail-slider.png', 'slider'));

        Article::factory()->create([
            'type' => 'photojournalism',
            'category_id' => $category->id,
            'title' => 'Draft Photo Detail Article',
            'slug' => 'draft-photo-detail-article',
            'status' => 'draft',
        ]);

        Article::factory()->create([
            'type' => 'videography',
            'category_id' => $category->id,
            'title' => 'Hidden Video Detail Article',
            'slug' => 'hidden-video-detail-article',
            'status' => 'hidden',
            'content_blocks' => [
                ['type' => 'paragraph', 'text' => 'Hidden video body from database.'],
            ],
        ]);

        Article::factory()->create([
            'type' => 'videography',
            'category_id' => $category->id,
            'title' => 'Video Detail Article',
            'slug' => 'video-detail-article',
            'status' => 'published',
            'youtube_urls' => ['abc123XYZ'],
            'content_blocks' => [
                ['type' => 'paragraph', 'text' => 'Video body from database.'],
            ],
        ]);

        $this->get('/event-photos/event-detail-album')
            ->assertOk()
            ->assertSee('Event Detail Album')
            ->assertSee('event-detail-gallery.png');

        $this->get('/event-photos/draft-event-detail-album')->assertNotFound();

        $this->get('/faces-and-places/faces-detail-album')
            ->assertOk()
            ->assertSee('Faces Detail Album')
            ->assertSee('faces-detail-gallery.png');

        $this->get('/photojournalism/photo-detail-article')
            ->assertOk()
            ->assertSee('Photo Detail Article')
            ->assertSee('Dynamic paragraph from database.')
            ->assertSee('photo-detail-slider.png');

        $this->get('/photojournalism/draft-photo-detail-article')->assertNotFound();

        $this->get('/videography/video-detail-article')
            ->assertOk()
            ->assertSee('Video Detail Article')
            ->assertSee('Video body from database.')
            ->assertSee('abc123XYZ');

        $this->get('/videography/hidden-video-detail-article')->assertNotFound();
    }

    public function test_admin_can_preview_non_public_frontend_records_and_indexes(): void
    {
        $this->createPage('home');
        $this->createPage('event-photos');
        $this->createPage('faces-and-places');
        $this->createPage('photojournalism');
        $this->createPage('videography');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = ArticleCategory::factory()->create(['name' => 'Private Drafts', 'slug' => 'private-drafts']);

        $eventAlbum = EventAlbum::factory()->create([
            'title' => 'Draft Event Preview Album',
            'slug' => 'draft-event-preview-album',
            'status' => 'draft',
            'is_featured' => true,
        ]);
        $eventAlbum->media()->create($this->mediaAttributes('draft-event-preview.png'));

        $facesAlbum = FacesPlacesAlbum::factory()->create([
            'title' => 'Hidden Faces Preview Album',
            'slug' => 'hidden-faces-preview-album',
            'status' => 'hidden',
        ]);
        $facesAlbum->media()->create($this->mediaAttributes('hidden-faces-preview.png'));

        $photoArticle = Article::factory()->create([
            'type' => 'photojournalism',
            'category_id' => $category->id,
            'title' => 'Draft Photo Preview Article',
            'slug' => 'draft-photo-preview-article',
            'status' => 'draft',
            'is_featured' => true,
            'content_blocks' => [
                ['type' => 'paragraph', 'text' => 'Draft photo preview body.'],
            ],
        ]);
        $photoArticle->media()->create($this->mediaAttributes('draft-photo-preview.png', 'slider'));

        Article::factory()->create([
            'type' => 'videography',
            'category_id' => $category->id,
            'title' => 'Hidden Video Preview Article',
            'slug' => 'hidden-video-preview-article',
            'status' => 'hidden',
            'content_blocks' => [
                ['type' => 'paragraph', 'text' => 'Hidden video preview body.'],
            ],
        ]);

        $this->actingAs($admin);

        $this->get('/event-photos/draft-event-preview-album')
            ->assertOk()
            ->assertSee('Draft Event Preview Album');

        $this->get('/faces-and-places/hidden-faces-preview-album')
            ->assertOk()
            ->assertSee('Hidden Faces Preview Album');

        $this->get('/photojournalism/draft-photo-preview-article')
            ->assertOk()
            ->assertSee('Draft Photo Preview Article')
            ->assertSee('Draft photo preview body.');

        $this->get('/videography/hidden-video-preview-article')
            ->assertOk()
            ->assertSee('Hidden Video Preview Article')
            ->assertSee('Hidden video preview body.');

        $this->get('/')
            ->assertOk()
            ->assertSee('Draft Event Preview Album')
            ->assertSee('Draft Photo Preview Article')
            ->assertSee('Hidden Video Preview Article');

        $this->get('/event-photos')
            ->assertOk()
            ->assertSee('Draft Event Preview Album');

        $this->get('/faces-and-places')
            ->assertOk()
            ->assertSee('Hidden Faces Preview Album');

        $this->get('/photojournalism')
            ->assertOk()
            ->assertSee('Draft Photo Preview Article');

        $this->get('/videography')
            ->assertOk()
            ->assertSee('Hidden Video Preview Article');
    }

    public function test_global_composers_render_settings_and_published_social_feeds(): void
    {
        $this->createPage('contact');

        Setting::factory()->create(['key' => 'contact_phone', 'value' => '099 9999 999']);
        Setting::factory()->create(['key' => 'contact_email', 'value' => 'hello@example.com']);
        Setting::factory()->create(['key' => 'social_instagram', 'value' => 'dynamicinstagram']);
        Setting::factory()->create(['key' => 'footer_author_name', 'value' => 'Dynamic Author']);

        SocialFeed::factory()->create([
            'image_url' => 'client/assets/static/home/visible-social-feed.png',
            'status' => 'published',
        ]);
        SocialFeed::factory()->create([
            'image_url' => 'client/assets/static/home/hidden-social-feed.png',
            'status' => 'hidden',
        ]);

        $response = $this->get('/contact');

        $response->assertOk();
        $response->assertSee('099 9999 999');
        $response->assertSee('hello@example.com');
        $response->assertSee('dynamicinstagram');
        $response->assertSee('Dynamic Author');
        $response->assertSee('visible-social-feed.png');
        $response->assertDontSee('hidden-social-feed.png');
    }

    private function createPage(string $key): Page
    {
        return Page::factory()->create([
            'key' => $key,
            'title' => ucfirst(str_replace('-', ' ', $key)),
            'hero_title' => ucfirst(str_replace('-', ' ', $key)),
            'hero_images' => [],
            'content' => [],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function mediaAttributes(string $fileName, string $collection = 'gallery'): array
    {
        return [
            'collection_name' => $collection,
            'file_name' => $fileName,
            'file_url' => "client/assets/static/testing/{$fileName}",
            'mime_type' => 'image/png',
            'size' => 1024,
            'width' => 1920,
            'height' => 1080,
            'custom_properties' => [],
            'priority' => 1,
        ];
    }
}
