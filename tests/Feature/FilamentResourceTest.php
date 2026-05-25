<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\EventAlbum;
use App\Models\FacesPlacesAlbum;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\SocialFeed;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class FilamentResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/settings')->assertRedirect('/admin/login');
        $this->get('/admin/partners')->assertRedirect('/admin/login');
        $this->get('/admin/social-feeds')->assertRedirect('/admin/login');
        $this->get('/admin/event-albums')->assertRedirect('/admin/login');
        $this->get('/admin/faces-places-albums')->assertRedirect('/admin/login');
        $this->get('/admin/article-categories')->assertRedirect('/admin/login');
        $this->get('/admin/articles')->assertRedirect('/admin/login');
    }

    public function test_admin_can_access_filament_resources(): void
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
        ]);
        $eventAlbum = EventAlbum::factory()->create([
            'slug' => 'admin-event-album',
        ]);
        $facesPlacesAlbum = FacesPlacesAlbum::factory()->create([
            'slug' => 'admin-faces-places-album',
        ]);
        $articleCategory = ArticleCategory::factory()->create([
            'slug' => 'admin-article-category',
        ]);
        $article = Article::factory()->create([
            'category_id' => $articleCategory->id,
            'slug' => 'admin-article',
        ]);

        $this->actingAs($admin);

        $this->get('/admin')->assertRedirect('/admin/users');
        $this->get('/admin/settings')->assertSuccessful();
        $this->get('/admin/partners')->assertSuccessful();
        $this->get('/admin/social-feeds')->assertSuccessful();
        $this->get('/admin/event-albums')->assertSuccessful();
        $this->get('/admin/event-albums/create')->assertSuccessful();
        $this->get("/admin/event-albums/{$eventAlbum->id}/edit")->assertSuccessful();
        $this->get('/admin/faces-places-albums')->assertSuccessful();
        $this->get('/admin/faces-places-albums/create')->assertSuccessful();
        $this->get("/admin/faces-places-albums/{$facesPlacesAlbum->id}/edit")->assertSuccessful();
        $this->get('/admin/article-categories')->assertSuccessful();
        $this->get('/admin/article-categories/create')->assertSuccessful();
        $this->get("/admin/article-categories/{$articleCategory->id}/edit")->assertSuccessful();
        $this->get('/admin/articles')->assertSuccessful();
        $this->get('/admin/articles/create')->assertSuccessful();
        $this->get("/admin/articles/{$article->id}/edit")->assertSuccessful();
    }

    public function test_model_crud_and_persistence(): void
    {
        // 1. Settings
        $setting = Setting::factory()->create([
            'group' => 'general',
            'key' => 'site_title',
            'value' => 'Là Hiếu Photography',
        ]);
        $this->assertDatabaseHas('settings', [
            'id' => $setting->id,
            'key' => 'site_title',
        ]);

        // 2. Partners
        $partner = Partner::factory()->create([
            'name' => 'Tech Corp',
            'status' => 'published',
        ]);
        $this->assertDatabaseHas('partners', [
            'id' => $partner->id,
            'name' => 'Tech Corp',
        ]);

        // 3. Social Feeds
        $feed = SocialFeed::factory()->create([
            'platform' => 'instagram',
            'status' => 'published',
        ]);
        $this->assertDatabaseHas('social_feeds', [
            'id' => $feed->id,
            'platform' => 'instagram',
        ]);

        // 4. Event Albums
        $eventAlbum = EventAlbum::factory()->create([
            'title' => 'P4G Vietnam Summit',
            'slug' => 'p4g-vietnam-summit',
            'status' => 'published',
        ]);
        $eventAlbum->media()->create([
            'collection_name' => 'gallery',
            'file_name' => 'p4g-gallery-1.png',
            'file_url' => 'event_albums/gallery/p4g-gallery-1.png',
            'mime_type' => 'image/png',
            'size' => 1024,
            'width' => 1920,
            'height' => 1080,
            'custom_properties' => [],
            'priority' => 1,
        ]);
        $this->assertDatabaseHas('event_albums', [
            'id' => $eventAlbum->id,
            'slug' => 'p4g-vietnam-summit',
        ]);
        $this->assertDatabaseHas('media', [
            'model_type' => EventAlbum::class,
            'model_id' => $eventAlbum->id,
            'collection_name' => 'gallery',
            'file_name' => 'p4g-gallery-1.png',
            'priority' => 1,
        ]);

        // 5. Faces & Places Albums
        $facesPlacesAlbum = FacesPlacesAlbum::factory()->create([
            'title' => 'Nature',
            'slug' => 'nature',
            'status' => 'published',
        ]);
        $facesPlacesAlbum->media()->create([
            'collection_name' => 'gallery',
            'file_name' => 'nature-gallery-1.png',
            'file_url' => 'faces_places_albums/gallery/nature-gallery-1.png',
            'mime_type' => 'image/png',
            'size' => 2048,
            'width' => 1600,
            'height' => 900,
            'custom_properties' => [],
            'priority' => 1,
        ]);
        $this->assertDatabaseHas('faces_places_albums', [
            'id' => $facesPlacesAlbum->id,
            'slug' => 'nature',
        ]);
        $this->assertDatabaseHas('media', [
            'model_type' => FacesPlacesAlbum::class,
            'model_id' => $facesPlacesAlbum->id,
            'collection_name' => 'gallery',
            'file_name' => 'nature-gallery-1.png',
            'priority' => 1,
        ]);

        // 6. Article Categories
        $articleCategory = ArticleCategory::factory()->create([
            'name' => 'Photojournalism',
            'slug' => 'photojournalism',
        ]);
        $this->assertDatabaseHas('article_categories', [
            'id' => $articleCategory->id,
            'name' => 'Photojournalism',
            'slug' => 'photojournalism',
        ]);

        // 7. Articles
        $contentBlocks = [
            [
                'type' => 'dropcap_paragraph',
                'dropcap' => 'A',
                'text' => 'A strong opening paragraph.',
            ],
            [
                'type' => 'link',
                'text' => 'Read the project notes',
                'link_text' => 'here',
                'url' => '#',
            ],
        ];
        $article = Article::factory()->create([
            'type' => 'videography',
            'category_id' => $articleCategory->id,
            'title' => 'Modern Travel Video',
            'slug' => 'modern-travel-video',
            'youtube_urls' => ['LXb3EKWsInQ', 'Qs2-klYtq5Y'],
            'content_blocks' => $contentBlocks,
            'status' => 'published',
        ]);
        $article->media()->create([
            'collection_name' => 'slider',
            'file_name' => 'article-slider-1.png',
            'file_url' => 'articles/slider/article-slider-1.png',
            'mime_type' => 'image/png',
            'size' => 1024,
            'width' => 1920,
            'height' => 1080,
            'custom_properties' => [],
            'priority' => 1,
        ]);

        $article->refresh();

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'slug' => 'modern-travel-video',
            'category_id' => $articleCategory->id,
        ]);
        $this->assertSame(['LXb3EKWsInQ', 'Qs2-klYtq5Y'], $article->youtube_urls);
        $this->assertSame($contentBlocks, $article->content_blocks);
        $this->assertDatabaseHas('media', [
            'model_type' => Article::class,
            'model_id' => $article->id,
            'collection_name' => 'slider',
            'file_name' => 'article-slider-1.png',
            'priority' => 1,
        ]);
    }

    public function test_album_models_can_be_soft_deleted_and_restored(): void
    {
        $eventAlbum = EventAlbum::factory()->create([
            'slug' => 'soft-delete-event-album',
        ]);
        $facesPlacesAlbum = FacesPlacesAlbum::factory()->create([
            'slug' => 'soft-delete-faces-places-album',
        ]);
        $article = Article::factory()->create([
            'slug' => 'soft-delete-article',
        ]);

        $eventAlbum->delete();
        $facesPlacesAlbum->delete();
        $article->delete();

        $this->assertSoftDeleted('event_albums', [
            'id' => $eventAlbum->id,
        ]);
        $this->assertSoftDeleted('faces_places_albums', [
            'id' => $facesPlacesAlbum->id,
        ]);
        $this->assertSoftDeleted('articles', [
            'id' => $article->id,
        ]);

        $eventAlbum->restore();
        $facesPlacesAlbum->restore();
        $article->restore();

        $this->assertNotSoftDeleted('event_albums', [
            'id' => $eventAlbum->id,
        ]);
        $this->assertNotSoftDeleted('faces_places_albums', [
            'id' => $facesPlacesAlbum->id,
        ]);
        $this->assertNotSoftDeleted('articles', [
            'id' => $article->id,
        ]);
    }
}
